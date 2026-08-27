/* ============================================================
   UI Controller
   Modals, Tabs, Dropdowns, Alerts, Form helpers
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
  initModals();
  initTabs();
  initDropdowns();
  initAlertDismiss();
  initFormValidation();
  initConfirmActions();
});

/* ─── Modals ─── */
function initModals() {
  // Open modal triggers
  document.querySelectorAll('[data-modal]').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const modalId = trigger.getAttribute('data-modal');
      openModal(modalId);
    });
  });

  // Close modal triggers
  document.querySelectorAll('[data-modal-close]').forEach(trigger => {
    trigger.addEventListener('click', (e) => {
      e.preventDefault();
      const modalId = trigger.getAttribute('data-modal-close');
      if (modalId) {
        closeModal(modalId);
      } else {
        // Close closest modal
        const modal = trigger.closest('.modal-overlay');
        if (modal) modal.classList.remove('show');
      }
    });
  });

  // Close on overlay click
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('show');
      }
    });
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.show').forEach(m => m.classList.remove('show'));
    }
  });
}

function openModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    // Focus first focusable element
    const focusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
    if (focusable) focusable.focus();
  }
}

function closeModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    modal.classList.remove('show');
    document.body.style.overflow = '';
  }
}

/* ─── Tabs ─── */
function initTabs() {
  document.querySelectorAll('[data-tab]').forEach(tab => {
    tab.addEventListener('click', () => {
      const tabGroup = tab.closest('.tabs');
      const panelId = tab.getAttribute('data-tab');

      // Deactivate all in group
      tabGroup.querySelectorAll('[data-tab]').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');

      // Show corresponding panel
      const container = tabGroup.nextElementSibling || document.querySelector(`[data-tab-panel="${panelId}"]`).parentElement;
      if (container) {
        container.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
        const panel = document.getElementById(panelId) || container.querySelector(`#${panelId}`);
        if (panel) panel.classList.add('active');
      }
    });
  });
}

/* ─── Dropdowns ─── */
function initDropdowns() {
  document.querySelectorAll('[data-dropdown-toggle]').forEach(toggle => {
    toggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const dropdownId = toggle.getAttribute('data-dropdown-toggle');
      const menu = document.getElementById(dropdownId);
      if (menu) {
        // Close others
        document.querySelectorAll('.dropdown-menu.show').forEach(m => {
          if (m !== menu) m.classList.remove('show');
        });
        menu.classList.toggle('show');
      }
    });
  });

  // Close on outside click
  document.addEventListener('click', () => {
    document.querySelectorAll('.dropdown-menu.show').forEach(m => m.classList.remove('show'));
  });
}

/* ─── Alert Dismiss ─── */
function initAlertDismiss() {
  document.querySelectorAll('.alert-dismissible .alert-close, [data-dismiss="alert"]').forEach(btn => {
    btn.addEventListener('click', () => {
      const alert = btn.closest('.alert');
      if (alert) {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-8px)';
        setTimeout(() => alert.remove(), 200);
      }
    });
  });
}

/* ─── Form Validation Helpers ─── */
function initFormValidation() {
  document.querySelectorAll('form[data-validate]').forEach(form => {
    form.addEventListener('submit', (e) => {
      let valid = true;
      form.querySelectorAll('[required]').forEach(field => {
        if (!field.value.trim()) {
          valid = false;
          field.classList.add('is-invalid');
          field.style.borderColor = 'var(--danger)';
        } else {
          field.classList.remove('is-invalid');
          field.style.borderColor = '';
        }
      });

      if (!valid) {
        e.preventDefault();
        // Focus first invalid
        const firstInvalid = form.querySelector('.is-invalid');
        if (firstInvalid) firstInvalid.focus();
      }
    });

    // Clear invalid on input
    form.querySelectorAll('[required]').forEach(field => {
      field.addEventListener('input', () => {
        if (field.value.trim()) {
          field.classList.remove('is-invalid');
          field.style.borderColor = '';
        }
      });
    });
  });
}

/* ─── Confirm Actions ─── */
function initConfirmActions() {
  document.querySelectorAll('[data-confirm]').forEach(el => {
    el.addEventListener('click', (e) => {
      const message = el.getAttribute('data-confirm');
      if (!confirm(message || 'Apakah Anda yakin?')) {
        e.preventDefault();
      }
    });
  });
}

/* ─── Utilities ─── */
function formatCurrency(amount) {
  if (typeof amount !== 'number') return 'Rp. 0';
  return 'Rp. ' + amount.toLocaleString('id-ID');
}

function formatDate(dateStr) {
  if (!dateStr) return '-';
  const d = new Date(dateStr);
  return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
}

function debounce(fn, ms = 300) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => fn(...args), ms);
  };
}
