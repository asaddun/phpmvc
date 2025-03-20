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

let prevScrollPos = window.scrollY;
const navbar = document.querySelector(".main-header");

window.onscroll = function () {
  let currentScrollPos = window.scrollY;
  if (prevScrollPos < currentScrollPos) {
    navbar.style.top = "-60px"; // Navbar hilang saat scroll ke bawah
  } else {
    navbar.style.top = "0"; // Navbar muncul saat scroll ke atas
  }
  prevScrollPos = currentScrollPos;
};

function togglePassword() {
  const passwordInput = document.getElementById("password");
  const icon = document.getElementById("icon-password");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
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
