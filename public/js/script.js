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

const sidebar = document.querySelector(".sidebar");
const overlay = document.querySelector(".sidebar-overlay");
document
  .getElementById("sidebarToggle")
  .addEventListener("click", function (e) {
    e.preventDefault();
    sidebar.classList.toggle("toggle");
    if (window.innerWidth <= 768) {
      overlay.style.display = sidebar.classList.contains("toggle")
        ? "block"
        : "none";
    } else {
      document.querySelector(".main").classList.toggle("toggle");
    }
  });

overlay.addEventListener("click", function () {
  sidebar.classList.remove("toggle");
  overlay.style.display = "none";
});

// Update icon when submenu is toggled
const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
toggles.forEach((toggle) => {
  const icon = toggle.querySelector(".submenu-icon");
  const targetId = toggle.getAttribute("href");
  const collapseEl = document.querySelector(targetId);

  collapseEl.addEventListener("show.bs.collapse", () => {
    icon.classList.remove("fa-chevron-down");
    icon.classList.add("fa-minus");
  });

  collapseEl.addEventListener("hide.bs.collapse", () => {
    icon.classList.remove("fa-minus");
    icon.classList.add("fa-chevron-down");
  });
});

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
