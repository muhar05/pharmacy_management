// Fungsi untuk memformat harga ke dalam format Rupiah
function formatRupiah(totalPrice) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(totalPrice);
}

$(document).ready(function () {
    $("#medicine-search").on("keyup", function () {
        let searchTerm = $(this).val().toLowerCase(); // Ambil nilai input pencarian
        $("#medicine-list .medicine-item").each(function () {
            let medicineName = $(this).data("name").toLowerCase(); // Ambil nama obat dari data atribut
            // Tampilkan/hilangkan item berdasarkan pencarian
            if (medicineName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Toggle customer type
    $('input[name="customer_type"]').on("change", function () {
        if ($(this).val() === "existing") {
            $("#existingCustomerSection").removeClass("hidden");
            $("#customerInfo").removeClass("hidden");
            $("#newCustomerSection").addClass("hidden");
            // Enable existing customer dropdown
            $("#customer_select").prop("disabled", false);
            // Disable new customer fields
            $(
                "#customer_name, #customer_phone_new, #customer_address_new"
            ).prop("disabled", true);
        } else {
            $("#existingCustomerSection").addClass("hidden");
            $("#customerInfo").addClass("hidden");
            $("#newCustomerSection").removeClass("hidden");
            // Clear existing customer selection & info
            $("#customer_select").val("");
            $("#customer_display, #phone_display, #address_display").val("");
            // Disable existing customer dropdown
            $("#customer_select").prop("disabled", true);
            // Enable new customer fields
            $(
                "#customer_name, #customer_phone_new, #customer_address_new"
            ).prop("disabled", false);
        }
        validateForm();
    });

    // Handle existing customer selection
    $("#customer_select").on("change", function () {
        const selected = $(this).find(":selected");
        if ($(this).val()) {
            $("#customer_display").val(selected.data("name"));
            $("#phone_display").val(selected.data("phone"));
            $("#address_display").val(selected.data("address"));
        } else {
            $("#customer_display, #phone_display, #address_display").val("");
        }
        validateForm();
    });

    // Handle new customer input
    $("#customer_name, #customer_phone_new, #customer_address_new").on(
        "input",
        function () {
            if ($("#new_customer").is(":checked")) {
                $("#customer_display").val($("#customer_name").val());
                $("#phone_display").val($("#customer_phone_new").val());
                $("#address_display").val($("#customer_address_new").val());
            }
            validateForm();
        }
    );

    // Form validation
    function validateForm() {
        const customerType = $('input[name="customer_type"]:checked').val();
        const checkoutBtn = $("#checkout-button");
        let isValid = false;

        if (customerType === "existing") {
            isValid = $("#customer_select").val() !== "";
        } else {
            const name = $("#customer_name").val().trim();
            const phone = $("#customer_phone_new").val().trim();
            const address = $("#customer_address_new").val().trim();
            isValid = name && phone && address;
        }

        // Check if at least one medicine is selected
        let medicineSelected = false;
        $(".quantity-input").each(function () {
            if (parseInt($(this).val()) > 0) {
                medicineSelected = true;
            }
        });

        checkoutBtn.prop("disabled", !(isValid && medicineSelected));
    }

    // Trigger validation on medicine quantity change
    $(document).on("input change", ".quantity-input", validateForm);

    // Form submission handler
    $("#checkout-form").on("submit", function (e) {
        const customerType = $('input[name="customer_type"]:checked').val();

        if (customerType === "existing") {
            // Remove new customer fields from submission
            $(
                "#customer_name, #customer_phone_new, #customer_address_new"
            ).prop("disabled", true);
        } else {
            // Remove existing customer field from submission
            $("#customer_select").prop("disabled", true);
        }
    });

    // Initialize
    validateForm();
});

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
    if (isDisabled) {
        element.classList.add("opacity-50", "cursor-not-allowed");
    } else {
        element.classList.remove("opacity-50", "cursor-not-allowed");
    }
    additionalClasses.forEach((cls) =>
        element.classList.toggle(cls, isDisabled)
    );
}

function updateCheckoutButtonStatus() {
    const checkoutButton = document.getElementById("checkout-button");
    const orderSummaryItems = document.querySelectorAll(".summary-item");
    const doctorInputContainer = document.getElementById(
        "doctor-input-container"
    );

    if (!checkoutButton) return;

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

    // Check customer validation
    const customerType = $('input[name="customer_type"]:checked').val();
    let customerValid = false;

    if (customerType === "existing") {
        customerValid = $("#customer_select").val() !== "";
    } else {
        const name = $("#customer_name").val()?.trim() || "";
        const phone = $("#customer_phone_new").val()?.trim() || "";
        const address = $("#customer_address_new").val()?.trim() || "";
        customerValid = name && phone && address;
    }

    // Check doctor validation for obat keras
    let doctorValid = true;
    if (hasObatKeras) {
        const doctorName =
            document.getElementById("doctor")?.value?.trim() || "";
        const doctorPhone =
            document.getElementById("phoneDoctor")?.value?.trim() || "";
        doctorValid = doctorName && doctorPhone;
    }

    const isFormValid = totalQuantity > 0 && customerValid && doctorValid;

    // Only add disabled style if disabled, remove if enabled
    if (isFormValid) {
        checkoutButton.disabled = false;
        checkoutButton.classList.remove("opacity-50", "cursor-not-allowed");
    } else {
        checkoutButton.disabled = true;
        checkoutButton.classList.add("opacity-50", "cursor-not-allowed");
    }

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
    const doctorInput = document.getElementById("doctor");
    const phoneDoctorInput = document.getElementById("phoneDoctor");

    if (!doctorInput || !phoneDoctorInput) return false;

    return (
        doctorInput.value.trim() !== "" && phoneDoctorInput.value.trim() !== ""
    );
}

function createOrderObject(
    customerType,
    customerId,
    customerName,
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

    const orderObject = {
        sale_date: new Date().toISOString().split("T")[0],
        total_amount: totalAmount,
        payment_status: hasObatKeras ? "Unpaid" : "Paid",
        medicines: medicines,
    };

    if (customerType === "existing") {
        orderObject.customer_id = customerId;
    } else {
        orderObject.customer_name = customerName;
        orderObject.customer_phone = customerPhone;
        orderObject.customer_address = customerAddress;
    }

    if (nameDoctor) orderObject.doctor_name = nameDoctor;
    if (phoneDoctor) orderObject.doctor_phone = phoneDoctor;

    return orderObject;
}

async function checkout() {
    const checkoutButton = document.getElementById("checkout-button");
    const orderSummaryItems = document.querySelectorAll(".summary-item");

    let nameDoctor = "";
    let phoneDoctor = "";

    const { medicines, hasObatKeras } = processOrderItems(orderSummaryItems);

    // Periksa apakah ada obat dalam pesanan
    if (medicines.length === 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Tidak ada obat yang dipilih!",
        });
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
            Swal.fire({
                icon: "warning",
                title: "Perhatian!",
                text: "Harap isi nama dan nomor telepon dokter untuk obat keras.",
            });
            return;
        }
    }

    const customerType = $('input[name="customer_type"]:checked').val();
    const customerId = $("#customer_select").val();
    const customerName = $("#customer_name").val();
    const customerPhone = $("#customer_phone_new").val();
    const customerAddress = $("#customer_address_new").val();

    const order = createOrderObject(
        customerType,
        customerId,
        customerName,
        customerPhone,
        customerAddress,
        medicines,
        nameDoctor,
        phoneDoctor,
        hasObatKeras
    );

    if (order.payment_status === "Unpaid") {
        const confirmPayment = await Swal.fire({
            icon: "info",
            title: "Konfirmasi Pembayaran",
            text: "Apakah Anda sudah melakukan konfirmasi ke dokter untuk obat keras? Klik OK jika sudah.",
            showCancelButton: true,
            confirmButtonText: "OK",
            cancelButtonText: "Batal",
        });

        if (confirmPayment.isConfirmed) {
            order.payment_status = "Paid";
        } else {
            return;
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

        // SweetAlert for success
        await Swal.fire({
            icon: "success",
            title: "Berhasil!",
            text: "Pesanan Anda telah diproses.",
        });

        // Reset semua input setelah berhasil
        clearOrderSummary();
        resetMedicineInputs();
        resetCustomerData();
        resetDoctorInputs(hasObatKeras);
    } catch (err) {
        console.error("Error:", err);

        const errorContainer = document.getElementById("error-container");
        errorContainer.innerHTML = "";

        if (err.message) {
            const errorData = JSON.parse(err.message.split(", Message: ")[1]);
            if (errorData.error) {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan!",
                    text: errorData.error,
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Terjadi kesalahan yang tidak terduga.",
                });
            }
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Terjadi kesalahan yang tidak terduga.",
            });
        }
    } finally {
        checkoutButton.disabled = false;
    }

    console.log("Order:", order);
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

function resetCustomerData() {
    // Reset existing customer
    $("#customer_select").val("");

    // Reset new customer
    $("#customer_name, #customer_phone_new, #customer_address_new").val("");

    // Reset display fields
    $("#customer_display, #phone_display, #address_display").val("");

    // Reset to existing customer
    $("#existing_customer").prop("checked", true);
    $("#existingCustomerSection").removeClass("hidden");
    $("#newCustomerSection").addClass("hidden");
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
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const checkoutForm = document.getElementById("checkout-form");

    // Toggle customer type
    $('input[name="customer_type"]').on("change", function () {
        if ($(this).val() === "existing") {
            $("#existingCustomerSection").removeClass("hidden");
            $("#customerInfo").removeClass("hidden");
            $("#newCustomerSection").addClass("hidden");
            // Enable existing customer dropdown
            $("#customer_select").prop("disabled", false);
            // Disable new customer fields
            $(
                "#customer_name, #customer_phone_new, #customer_address_new"
            ).prop("disabled", true);
        } else {
            $("#existingCustomerSection").addClass("hidden");
            $("#customerInfo").addClass("hidden");
            $("#newCustomerSection").removeClass("hidden");
            // Clear existing customer selection & info
            $("#customer_select").val("");
            $("#customer_display, #phone_display, #address_display").val("");
            // Disable existing customer dropdown
            $("#customer_select").prop("disabled", true);
            // Enable new customer fields
            $(
                "#customer_name, #customer_phone_new, #customer_address_new"
            ).prop("disabled", false);
        }
        validateForm();
    });

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
    updateCheckoutButtonStatus();
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

        // Add event listeners to doctor inputs for validation
        document
            .getElementById("doctor")
            .addEventListener("input", updateCheckoutButtonStatus);
        document
            .getElementById("phoneDoctor")
            .addEventListener("input", updateCheckoutButtonStatus);
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
    } else {
        alert("Stok tidak mencukupi");
    }
}

function handleDecrement(medicineId) {
    const item = getItemElements(medicineId);
    const { input, stockDisplay, itemElement } = item;

    let stock = parseInt(itemElement.dataset.stock);
    let currentQuantity = parseInt(input.value);

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
