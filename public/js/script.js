$(document).ready(function () {
  // Saat area di luar sidebar diklik, tutup sidebar (khusus mobile)
  $(document).click(function (event) {
    var body = $("body");
    var sidebar = $(".main-sidebar"); // Sidebar
    var toggleButton = $('[data-widget="pushmenu"]'); // Tombol toggle

    // Jika sidebar terbuka dan klik bukan di sidebar atau tombol toggle
    if (
      body.hasClass("sidebar-open") &&
      !$(event.target).closest(sidebar).length &&
      !$(event.target).closest(toggleButton).length
    ) {
      body.removeClass("sidebar-open").addClass("sidebar-collapse");
    }
  });
});

function togglePassword() {
  const passwordInput = document.getElementById("password");
  const icon = document.getElementById("icon-password");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  } else {
    passwordInput.type = "password";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  }
}

function showConfirmationDelete(data) {
  const ticketNumber = data;
  Swal.fire({
    title: "Hapus Tiket?",
    text: "Apakah Anda yakin ingin menghapus tiket ini?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, Hapus",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = BASEURL + "/ticket/delete/" + ticketNumber;
    }
  });
}

function showConfirmationSend(data) {
  const ticketNumber = data;
  Swal.fire({
    title: "Kirim Tiket?",
    text: "Apakah Anda yakin ingin mengirim tiket ini ke antrian?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, kirim",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = BASEURL + "/ticket/send/" + ticketNumber;
    }
  });
}

function showConfirmationCancel(data) {
  const ticketNumber = data;
  Swal.fire({
    title: "Batalkan Tiket?",
    text: "Apakah Anda yakin ingin membatalkan tiket ini dari antrian?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, Batal",
    cancelButtonText: "Tidak",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = BASEURL + "/ticket/cancel/" + ticketNumber;
    }
  });
}

const editModal = document.getElementById("editModal");
if (editModal) {
  editModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget; // Tombol yang diklik
    const fullname_edit = button.getAttribute("data-fullname");
    const subject_edit = button.getAttribute("data-subject");
    const description_edit = button.getAttribute("data-description");
    const ticketNumber_edit = button.getAttribute("data-ticketNumber");

    // Isi modal
    document.getElementById("fullname-edit").value = fullname_edit;
    document.getElementById("subject-edit").value = subject_edit;
    document.getElementById("description-edit").value = description_edit;
    document.getElementById("ticketnumber-edit").textContent =
      ticketNumber_edit;
    document.getElementById("form-edit").action =
      BASEURL + "/ticket/update/" + ticketNumber_edit;
  });
}

const infoModal = document.getElementById("infoModal");
if (infoModal) {
  infoModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget; // Tombol yang diklik
    const fullname_info = button.getAttribute("data-fullname");
    const subject_info = button.getAttribute("data-subject");
    const description_info = button.getAttribute("data-description");
    const ticketNumber_info = button.getAttribute("data-ticketNumber");
    const status_info = button.getAttribute("data-status");
    const action_info = button.getAttribute("data-action");

    const action_area = document.getElementById("action-info-area");
    const action_textarea = document.getElementById("action-info-textarea");
    // Isi modal
    document.getElementById("fullname-info").textContent = fullname_info;
    document.getElementById("subject-info").textContent = subject_info;
    document.getElementById("description-info").textContent = description_info;
    document.getElementById("ticketnumber-info").textContent =
      ticketNumber_info;
    document.getElementById("status-info").textContent =
      status_ticket(status_info);

    if (status_info === "4" || status_info === "5") {
      action_area.classList.remove("d-none");
      action_textarea.disabled = true;
      if (action_info) {
        action_textarea.value = action_info;
      }
    } else {
      action_area.classList.add("d-none");
    }
  });
}

const processModal = document.getElementById("processModal");
if (processModal) {
  processModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget; // Tombol yang diklik
    // console.log(button);
    const fullname_process = button.getAttribute("data-fullname");
    const subject_process = button.getAttribute("data-subject");
    const description_process = button.getAttribute("data-description");
    const status_process = button.getAttribute("data-status");
    const ticketNumber_process = button.getAttribute("data-ticketNumber");
    const action_process = button.getAttribute("data-action");

    const processButton = document.getElementById("processButton");
    const holdButton = document.getElementById("holdButton");
    const closeButton = document.getElementById("closeButton");

    const action_area = document.getElementById("action-process-area");
    const action_textarea = document.getElementById("action-process-textarea");

    // Isi modal
    document.getElementById("fullname-process").textContent = fullname_process;
    document.getElementById("subject-process").textContent = subject_process;
    document.getElementById("description-process").textContent =
      description_process;
    document.getElementById("ticketnumber-process").textContent =
      ticketNumber_process;
    document.getElementById("status-process").textContent =
      status_ticket(status_process);
    document.getElementById("form-process").action =
      BASEURL + "/ticket/process/" + ticketNumber_process;
    document.getElementById("form-hold").action =
      BASEURL + "/ticket/hold/" + ticketNumber_process;
    document.getElementById("form-close").action =
      BASEURL + "/ticket/close/" + ticketNumber_process;

    holdButton.addEventListener("click", function () {
      appendTextareaToForm("form-hold");
    });
    closeButton.addEventListener("click", function () {
      appendTextareaToForm("form-close");
    });

    if (status_process === "2") {
      processButton.classList.remove("d-none");
      holdButton.classList.add("d-none");
      closeButton.classList.add("d-none");
      action_area.classList.add("d-none");
    } else if (status_process === "3") {
      processButton.classList.add("d-none");
      holdButton.classList.remove("d-none");
      closeButton.classList.remove("d-none");
      action_area.classList.remove("d-none");
      action_textarea.disabled = false;
      action_textarea.value = "";
    } else if (status_process === "4") {
      processButton.classList.remove("d-none");
      holdButton.classList.add("d-none");
      closeButton.classList.add("d-none");
      action_area.classList.remove("d-none");
      action_textarea.disabled = true;
      if (action_process) {
        action_textarea.value = action_process;
      }
    }
  });
}

function appendTextareaToForm(formId) {
  const textarea = document.getElementById("action-process-textarea");
  const form = document.getElementById(formId);

  // Check if textarea already exists in the form to avoid duplicates
  if (!form.querySelector("textarea")) {
    const clone = textarea.cloneNode(true);
    clone.name = "action"; // Set a name attribute so the value is submitted
    form.appendChild(clone);
  }
}

function status_ticket(status) {
  switch (status) {
    case "1":
      return "Draft"; // baru bikin, masih bisa edit/hapus, belum masuk antrian
    case "2":
      return "In Queue"; // dalam antrian, hanya bisa cancel
    case "3":
      return "On Process"; // sedang dikerjakan, tidak bisa diubah user
    case "4":
      return "On Hold"; // ditunda, hanya bisa cancel
    case "5":
      return "Closed"; // selesai
    case "6":
      return "Canceled"; // dibatalkan
    case "7":
      return "Deleted"; // user menghapus, batal membuat tiket
  }
}

function copyTable() {
  let table = document.getElementById("dataTable");
  let range = document.createRange();
  range.selectNode(table);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(range);
  document.execCommand("copy");
  window.getSelection().removeAllRanges();
  alert("Data tabel telah disalin!");
}

const problemProcessModal = document.getElementById("problemProcessModal");
if (problemProcessModal) {
  problemProcessModal.addEventListener("show.bs.modal", function (event) {
    const button = event.relatedTarget; // Tombol yang diklik
    // console.log(button);
    const subject_process = button.getAttribute("data-subject");
    const description_process = button.getAttribute("data-description");
    const status_process = button.getAttribute("data-status");

    const processButton = document.getElementById("processButton");
    const holdButton = document.getElementById("holdButton");
    const closeButton = document.getElementById("closeButton");

    const action_area = document.getElementById("action-process-area");
    const action_textarea = document.getElementById("action-process-textarea");

    // Isi modal
    document.getElementById("subject-process").textContent = subject_process;
    document.getElementById("description-process").value = description_process;
    document.getElementById("status-process").textContent =
      status_ticket(status_process);

    if (status_process === "2") {
      processButton.classList.remove("d-none");
      holdButton.classList.add("d-none");
      closeButton.classList.add("d-none");
      action_area.classList.add("d-none");
    } else if (status_process === "3") {
      processButton.classList.add("d-none");
      holdButton.classList.remove("d-none");
      closeButton.classList.remove("d-none");
      action_area.classList.remove("d-none");
      action_textarea.disabled = false;
      action_textarea.value = "";
    } else if (status_process === "4") {
      processButton.classList.remove("d-none");
      holdButton.classList.add("d-none");
      closeButton.classList.add("d-none");
      action_area.classList.remove("d-none");
      action_textarea.disabled = true;
      if (action_process) {
        action_textarea.value = action_process;
      }
    }
  });
}
