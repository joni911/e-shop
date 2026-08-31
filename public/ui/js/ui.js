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

  // Close on overlay click (dukung .modal-overlay & .x-modal-overlay)
  document.querySelectorAll('.modal-overlay, .x-modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        overlay.classList.remove('show');
      }
    });
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.show, .x-modal-overlay.show').forEach(m => m.classList.remove('show'));
    }
  });
}

function openModal(id) {
  const modal = document.getElementById(id);
  if (modal) {
    // Hoist modal ke <body> jika berada di dalam kontainer tersembunyi
    // (mis. tab-pane Bootstrap non-aktif). position:fixed TIDAK menembus
    // ancestor display:none/visibility:hidden, jadi modal di tab selain yang
    // aktif tidak akan terlihat walaupun class .show ditambahkan.
    let parent = modal.parentElement;
    while (parent && parent !== document.body) {
      const style = window.getComputedStyle(parent);
      if (style.display === 'none' || style.visibility === 'hidden') {
        document.body.appendChild(modal);
        break;
      }
      parent = parent.parentElement;
    }
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
  // Aktif untuk semua form yang punya input [required] (tidak perlu data-validate).
  document.querySelectorAll('form').forEach(form => {
    // Skip jika form tidak punya field required sama sekali
    if (!form.querySelector('[required]')) return;

    form.addEventListener('submit', (e) => {
      let valid = true;
      const firstInvalid = validateForm(form, () => { valid = false; });

      if (!valid) {
        e.preventDefault();
        if (firstInvalid) firstInvalid.focus();
        // Popup error UX: beri tahu user field mana yang belum diisi
        const missing = getMissingLabels(form);
        if (missing.length > 0) {
          showToast('Lengkapi field wajib: ' + missing.join(', '), 'danger', 6000);
        }
      }
    });

    // Clear invalid state saat user mulai mengisi/memilih file
    form.querySelectorAll('[required]').forEach(field => {
      const evt = field.type === 'file' ? 'change' : 'input';
      field.addEventListener(evt, () => {
        if (isFieldValid(field)) {
          field.classList.remove('is-invalid');
          field.style.borderColor = '';
          const wrapper = field.closest('.form-file');
          if (wrapper) wrapper.classList.remove('has-error');
          const label = wrapper?.querySelector('.form-file-label');
          if (label) label.style.borderColor = '';
        }
      });
    });
  });
}

function validateForm(form, onInvalid) {
  let firstInvalid = null;
  form.querySelectorAll('[required]').forEach(field => {
    if (!isFieldValid(field)) {
      field.classList.add('is-invalid');
      if (field.type !== 'file') field.style.borderColor = 'var(--danger)';
      const wrapper = field.closest('.form-file');
      if (wrapper) wrapper.classList.add('has-error');
      if (!firstInvalid) firstInvalid = field;
      if (onInvalid) onInvalid();
    } else {
      field.classList.remove('is-invalid');
      if (field.type !== 'file') field.style.borderColor = '';
      const wrapper = field.closest('.form-file');
      if (wrapper) wrapper.classList.remove('has-error');
    }
  });
  return firstInvalid;
}

function isFieldValid(field) {
  if (field.type === 'file') {
    return field.files.length > 0;
  }
  return field.value.trim() !== '';
}

function getMissingLabels(form) {
  const missing = [];
  form.querySelectorAll('[required]').forEach(field => {
    if (!isFieldValid(field)) {
      const label = field.closest('.form-group, .mb-3, .mb-4, .form-section')
        ?.querySelector('.form-label, label');
      const text = label?.textContent.replace(/\s+/, ' ').trim() || field.name || field.id;
      if (text && !missing.includes(text)) missing.push(text.replace(/\s*\*\s*$/, '').replace(/\s+/, ' '));
    }
  });
  return missing.slice(0, 5);
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

/* Fallback showToast bila app.js belum dimuat (ui.js dimuat lebih dulu) */
function showToast(message, type = 'info', duration = 3000) {
  if (typeof window.__toastShown === 'undefined') {
    window.__toastShown = true;
    setTimeout(() => { window.__toastShown = false; }, 100);
  }
  const toast = document.createElement('div');
  toast.className = `alert alert-${type}`;
  toast.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    max-width: 400px;
    animation: slideInRight 300ms ease;
  `;
  toast.innerHTML = `
    <span class="alert-content">${String(message)}</span>
    <button class="alert-close" style="background:none;border:none;cursor:pointer;margin-left:12px;color:inherit;">×</button>
  `;
  document.body.appendChild(toast);
  const close = toast.querySelector('.alert-close');
  if (close) close.addEventListener('click', () => toast.remove());
  setTimeout(() => toast.remove(), duration);
}

function debounce(fn, ms = 300) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => fn(...args), ms);
  };
}
