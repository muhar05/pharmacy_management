// Fungsi untuk memformat harga ke dalam format Rupiah
function formatRupiah(totalPrice) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(totalPrice);
}

// Helper untuk mengatur atribut elemen
function setElementAttributes(element, attributes) {
    Object.keys(attributes).forEach((attr) =>
        element.setAttribute(attr, attributes[attr])
    );
}

// Helper untuk mengatur status elemen
function toggleElementState(element, isDisabled, additionalClasses = []) {
    element.disabled = isDisabled;
    element.readOnly = isDisabled;
    element.classList.toggle("opacity-50", isDisabled);
    element.classList.toggle("cursor-not-allowed", isDisabled);
    additionalClasses.forEach((cls) =>
        element.classList.toggle(cls, isDisabled)
    );
}

function updateCheckoutButtonStatus() {
    const checkoutButton = document.getElementById("checkout-button");
    const customerInput = document.getElementById("customer");
    const customerPhoneInput = document.getElementById("customerPhone");
    const customerAddressInput = document.getElementById("customerAddress");
    const orderSummaryItems = document.querySelectorAll(".summary-item");
    const doctorInputContainer = document.getElementById(
        "doctor-input-container"
    );

    if (
        !checkoutButton ||
        !customerInput ||
        !customerPhoneInput ||
        !customerAddressInput
    )
        return; // Prevent errors if these elements are missing

    let hasObatKeras = false;
    let totalQuantity = 0;

    orderSummaryItems.forEach((item) => {
        const quantity = parseInt(
            item.querySelector(".summary-quantity")?.textContent || "0"
        );
        const category = item.querySelector("#category")?.textContent || "";
        totalQuantity += quantity;
        if (category === "Obat Keras") hasObatKeras = true;
    });

    toggleElementState(customerInput, totalQuantity === 0);
    toggleElementState(customerPhoneInput, totalQuantity === 0);
    toggleElementState(customerAddressInput, totalQuantity === 0);
    toggleElementState(
        checkoutButton,
        totalQuantity === 0 ||
            (hasObatKeras && (!doctorInputContainer || !isDoctorInputValid()))
    );

    if (hasObatKeras) {
        if (doctorInputContainer) {
            doctorInputContainer.style.display = "block";
            setElementAttributes(doctorInputContainer, { required: true });
        }
    } else {
        if (doctorInputContainer) {
            doctorInputContainer.style.display = "none";
            doctorInputContainer
                .querySelectorAll("input")
                .forEach((input) => input.removeAttribute("required"));
        }
    }
}

function isDoctorInputValid() {
    const doctorInput = document.getElementById("doctor").value.trim();
    const phoneDoctorInput = document
        .getElementById("phoneDoctor")
        .value.trim();
    return doctorInput !== "" && phoneDoctorInput !== "";
}

function createOrderObject(
    customerValue,
    customerPhone,
    customerAddress,
    medicines,
    nameDoctor,
    phoneDoctor,
    hasObatKeras
) {
    const totalAmount = medicines.reduce(
        (total, medicine) => total + medicine.price * medicine.quantity,
        0
    );

    // Membuat objek dasar
    const orderObject = {
        customer: customerValue, // Assuming customerValue is the ID of the customer
        customer_phone: customerPhone,
        customer_address: customerAddress,
        sale_date: new Date().toISOString().split("T")[0], // Format the date as needed
        total_amount: totalAmount,
        payment_status: hasObatKeras ? "Unpaid" : "Paid", // Example logic for payment status
        medicines: medicines, // You might want to send the medicines too, if needed
    };

    // Menambahkan properti name_doctor dan phone_doctor jika tidak kosong
    if (nameDoctor) {
        orderObject.doctor_name = nameDoctor;
    }
    if (phoneDoctor) {
        orderObject.doctor_phone = phoneDoctor;
    }

    return orderObject;
}

async function checkout() {
    const checkoutButton = document.getElementById("checkout-button");
    const inputCustomer = document.getElementById("customer");
    const inputCustomerPhone = document.getElementById("customerPhone");
    const inputCustomerAddress = document.getElementById("customerAddress");
    const orderSummaryItems = document.querySelectorAll(".summary-item");

    // Tambahkan deklarasi default untuk nameDoctor dan phoneDoctor
    let nameDoctor = "";
    let phoneDoctor = "";

    const { medicines, hasObatKeras } = processOrderItems(orderSummaryItems);

    // Periksa apakah ada obat dalam pesanan
    if (medicines.length === 0) {
        alert("Tidak ada obat yang dipilih");
        return;
    }

    // Cek apakah ada obat keras
    if (hasObatKeras) {
        const doctorInput = document.getElementById("doctor");
        const phoneDoctorInput = document.getElementById("phoneDoctor");

        if (doctorInput) {
            nameDoctor = doctorInput.value.trim();
        }

        if (phoneDoctorInput) {
            phoneDoctor = phoneDoctorInput.value.trim();
        }

        // Validasi input dokter jika ada obat keras
        if (!nameDoctor || !phoneDoctor) {
            alert("Harap isi nama dan nomor telepon dokter untuk obat keras");
            return;
        }
    }

    const order = createOrderObject(
        inputCustomer.value.trim(),
        inputCustomerPhone.value.trim(),
        inputCustomerAddress.value.trim(),
        medicines,
        nameDoctor, // Tambahkan parameter
        phoneDoctor, // Tambahkan parameter
        hasObatKeras
    );

    if (order.payment_status === "Unpaid") {
        alert("Silahkan melakukan pembayaran terlebih dahulu");
        const confirmPayment = confirm(
            "Apakah anda sudah melakukan konfirmasi ke dokter yang bersangkut pada obat keras? jika sudah konfirmasi silahkan klik OK"
        );

        if (confirmPayment) {
            order.payment_status = "Paid";
        }
    }

    // Get CSRF token from meta tag
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    try {
        const response = await fetch("/checkout", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(order),
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(
                `HTTP error! Status: ${
                    response.status
                }, Message: ${JSON.stringify(errorData)}`
            );
        }

        const data = await response.json();
        console.log("Success:", data);
        // Handle success (e.g., show a success message)
    } catch (err) {
        console.error("Error:", err);

        // Menampilkan pesan kesalahan di frontend
        const errorContainer = document.getElementById("error-container");
        errorContainer.innerHTML = ""; // Kosongkan sebelumnya

        // Memeriksa apakah ada pesan kesalahan dari server
        if (err.message) {
            const errorData = JSON.parse(err.message.split(", Message: ")[1]); // Mengambil data error
            if (errorData.error) {
                // Menampilkan pesan kesalahan spesifik dari server
                errorContainer.innerHTML += `<p class="text-red-700">${errorData.error}</p>`;
            } else {
                // Menampilkan error umum
                errorContainer.innerHTML += `<p class="text-red-700">Terjadi kesalahan yang tidak terduga.</p>`;
            }
        } else {
            // Menampilkan error umum
            errorContainer.innerHTML += `<p class="text-red-700">Terjadi kesalahan yang tidak terduga.</p>`;
        }
    } finally {
        checkoutButton.disabled = false; // Aktifkan kembali tombol
    }

    console.log("Order:", order);

    resetCustomerInput(inputCustomer, checkoutButton);
    resetCustomerPhoneInput(inputCustomerPhone, checkoutButton);
    resetCustomerAddressInput(inputCustomerAddress, checkoutButton);
    resetDoctorInputs(hasObatKeras);
    clearOrderSummary();
    resetMedicineInputs();
}

function processOrderItems(orderSummaryItems) {
    const medicines = [];
    let hasObatKeras = false;

    orderSummaryItems.forEach((item) => {
        const medicine = extractMedicineData(item);
        medicines.push(medicine);

        if (medicine.category === "Obat Keras") {
            hasObatKeras = true;
        }

        resetStock(medicine.name);
    });

    return { medicines, hasObatKeras };
}

function extractMedicineData(item) {
    const name = item.getAttribute("data-name");
    const medicine_id = Number(item.getAttribute("data-id"));
    const quantity = parseInt(
        item.querySelector(".summary-quantity").textContent
    );
    const categoryElement = item.querySelector("#category");
    const category = categoryElement ? categoryElement.textContent : "Unknown";
    const price = parseFloat(
        item.querySelector(".summary-price").dataset.price
    );

    return { quantity, price, medicine_id, category };
}

function resetStock(medicineName) {
    const medicineItem = document.querySelector(
        `.medicine-item[data-name="${medicineName}"]`
    );
    if (medicineItem) {
        const initialStock = parseInt(medicineItem.dataset.initialStock);
        medicineItem.dataset.stock = initialStock;
        medicineItem.dataset.quantity = 0;
    }
}

function resetCustomerInput(inputCustomer, checkoutButton) {
    inputCustomer.value = "";
    inputCustomer.disabled = true;
    inputCustomer.classList.add("opacity-50", "cursor-not-allowed");

    checkoutButton.disabled = true;
    checkoutButton.classList.add("opacity-50", "cursor-not-allowed");
}

function resetCustomerPhoneInput(inputCustomerPhone, checkoutButton) {
    inputCustomerPhone.value = "";
    inputCustomerPhone.disabled = true;
    inputCustomerPhone.classList.add("opacity-50", "cursor-not-allowed");

    checkoutButton.disabled = true;
    checkoutButton.classList.add("opacity-50", "cursor-not-allowed");
}

function resetCustomerAddressInput(inputCustomerAddress, checkoutButton) {
    inputCustomerAddress.value = "";
    inputCustomerAddress.disabled = true;
    inputCustomerAddress.classList.add("opacity-50", "cursor-not-allowed");

    checkoutButton.disabled = true;
    checkoutButton.classList.add("opacity-50", "cursor-not-allowed");
}

function resetDoctorInputs(hasObatKeras) {
    if (hasObatKeras) {
        const doctorInput = document.getElementById("doctor");
        const phoneDoctorInput = document.getElementById("phoneDoctor");

        if (doctorInput) doctorInput.value = "";
        if (phoneDoctorInput) phoneDoctorInput.value = "";

        const doctorInputContainer = document.getElementById(
            "doctor-input-container"
        );
        if (doctorInputContainer) doctorInputContainer.remove();
    }
}

function clearOrderSummary() {
    document.querySelector("#order-summary .total-quantity").textContent = "0";
    document.querySelector("#order-summary .total-price").textContent =
        formatRupiah(0);

    document
        .querySelectorAll("#order-summary .summary-item")
        .forEach((item) => item.remove());
}

function resetMedicineInputs() {
    document
        .querySelectorAll('.medicine-item input[type="text"]')
        .forEach((input) => {
            input.value = "0";
            input.disabled = true;
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const checkoutForm = document.getElementById("checkout-form");
    const customerInput = document.getElementById("customer");
    const customerPhoneInput = document.getElementById("customerPhone");
    const customerAddressInput = document.getElementById("customerAddress");
    const checkoutButton = document.getElementById("checkout-button");
    const orderSummaryItems = document.querySelectorAll(".summary-item");

    orderSummaryItems.forEach((item) => {
        const quantityElement = item.querySelector(".summary-quantity");
        quantityElement.addEventListener("input", updateCheckoutButtonStatus);
    });

    customerInput.classList.add("opacity-50", "cursor-not-allowed");

    if (customerInput.value.trim() === "") {
        customerInput.addEventListener("input", updateCheckoutButtonStatus);
        customerPhoneInput.addEventListener(
            "input",
            updateCheckoutButtonStatus
        );
        customerAddressInput.addEventListener(
            "input",
            updateCheckoutButtonStatus
        );
        checkoutButton.addEventListener("click", updateCheckoutButtonStatus);
    } else {
        updateCheckoutButtonStatus();
    }

    // Ganti penanganan tombol checkout dengan penanganan form
    checkoutForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Mencegah pengiriman form default
        checkout(); // Panggil fungsi checkout
    });
});

function updateOrderSummary(medicineId) {
    const item = document.querySelector(
        `.medicine-item[data-id="${medicineId}"]`
    );
    const name = item.dataset.name;
    const id = item.dataset.id;
    const category = item.dataset.category;
    const price = parseFloat(item.dataset.price);
    const quantity = parseInt(item.dataset.quantity);

    const orderSummary = document.querySelector("#order-summary");
    const formResep = document.querySelector("#form-resep");

    updateSummaryItem(orderSummary, name, category, price, quantity, id);
    handleDoctorInput(formResep, category);
    updateTotals(orderSummary);
}

function updateSummaryItem(orderSummary, name, category, price, quantity, id) {
    let existingItem = orderSummary.querySelector(
        `.summary-item[data-name="${name}"]`
    );

    if (existingItem) {
        if (quantity > 0) {
            updateExistingItem(existingItem, price, quantity, id);
        } else {
            existingItem.remove(); // Hapus item jika kuantitas 0
        }
    } else if (quantity > 0) {
        createNewSummaryItem(orderSummary, name, category, price, quantity, id);
    }
}

function updateExistingItem(item, price, quantity, id) {
    item.querySelector(".summary-quantity").textContent = quantity;
    item.querySelector(".summary-price").textContent = formatRupiah(
        price * quantity
    );
}

function createNewSummaryItem(
    orderSummary,
    name,
    category,
    price,
    quantity,
    id
) {
    const newSummaryItem = document.createElement("div");
    newSummaryItem.className = "summary-item space-y-2";
    newSummaryItem.setAttribute("data-name", name);
    newSummaryItem.setAttribute("data-id", id);
    newSummaryItem.innerHTML = `
        <dl class="flex items-center justify-between gap-4">
            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">${name} || <span class="font-medium" id="category">${category}</span></dt>
            <dd class="text-base font-medium text-green-600">
                <span class="summary-quantity">${quantity}</span> pcs
            </dd>
            <dd class="text-base font-bold text-gray-900 dark:text-white summary-price" data-price="${price}">
                ${formatRupiah(price * quantity)}
            </dd>
        </dl>
    `;
    orderSummary.appendChild(newSummaryItem);
}

function handleDoctorInput(formResep, category) {
    if (
        category === "Obat Keras" &&
        !document.querySelector("#doctor-input-container")
    ) {
        const doctorInputContainer = createDoctorInput();
        formResep.appendChild(doctorInputContainer);
    }
}

function createDoctorInput() {
    const container = document.createElement("div");
    container.id = "doctor-input-container";
    container.innerHTML = `
        <label for="doctor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">
            Doctor Name
        </label>
        <input type="text" name="doctor" id="doctor"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Dr. Muharrem" required>
        <label for="phoneDoctor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-4">
            Phone
        </label>
        <input type="number" name="phoneDoctor" id="phoneDoctor"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="+620834343xxx" required>
    `;
    return container;
}

function updateTotals(orderSummary) {
    let totalQuantity = 0;
    let totalPrice = 0;

    orderSummary.querySelectorAll(".summary-item").forEach((summaryItem) => {
        const quantity = parseInt(
            summaryItem.querySelector(".summary-quantity").textContent
        );
        const price = parseFloat(
            summaryItem.querySelector(".summary-price").dataset.price
        );
        totalQuantity += quantity;
        totalPrice += price * quantity;
    });

    document.querySelector("#order-summary .total-quantity").textContent =
        totalQuantity;
    document.querySelector("#order-summary .total-price").textContent =
        formatRupiah(totalPrice);
}

function initIncrementButtons() {
    document.querySelectorAll(".increment-button").forEach((button) => {
        button.addEventListener("click", () =>
            handleIncrement(button.dataset.id)
        );
    });
}

function initDecrementButtons() {
    document.querySelectorAll(".decrement-button").forEach((button) => {
        button.addEventListener("click", () =>
            handleDecrement(button.dataset.id)
        );
    });
}

function handleIncrement(medicineId) {
    const item = getItemElements(medicineId);
    const { input, stockDisplay, itemElement } = item;

    let stock = parseInt(itemElement.dataset.stock);
    let currentQuantity = parseInt(input.value);

    if (stock > 0) {
        currentQuantity++;
        stock--;

        updateItemData(
            itemElement,
            input,
            stockDisplay,
            stock,
            currentQuantity
        );
        if (stock === 0) {
            alert("Stok sudah habis");
        }
        updateOrderSummary(medicineId);
        updateCheckoutButtonStatus();
    } else {
        alert("Stok tidak mencukupi");
    }
}

function handleDecrement(medicineId) {
    const item = getItemElements(medicineId);
    const { input, stockDisplay, itemElement } = item;

    let stock = parseInt(itemElement.dataset.stock);
    let currentQuantity = parseInt(input.value);
    const maxStock = parseInt(itemElement.dataset.maxStock || stock);

    if (currentQuantity > 0) {
        currentQuantity--;
        stock++;

        updateItemData(
            itemElement,
            input,
            stockDisplay,
            stock,
            currentQuantity
        );
        updateOrderSummary(medicineId);
        updateCheckoutButtonStatus();
    } else {
        console.log("Tidak bisa decrement lebih lanjut");
    }
}

function getItemElements(medicineId) {
    const itemElement = document.querySelector(
        `.medicine-item[data-id="${medicineId}"]`
    );
    const input = document.querySelector(`#counter-input-${medicineId}`);
    const stockDisplay = itemElement.querySelector(".stock-quantity");

    return { itemElement, input, stockDisplay };
}

function updateItemData(itemElement, input, stockDisplay, stock, quantity) {
    input.value = quantity;
    itemElement.dataset.stock = stock;
    itemElement.dataset.quantity = quantity;
    stockDisplay.textContent = stock;
}

// Inisialisasi event listener
initIncrementButtons();
initDecrementButtons();
