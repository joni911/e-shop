/* ============================================================
   App Controller
   Init, data fetching, shared logic
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
  initMobileChecks();
  initTableSearch();
  initFileInputs();
});

/* ─── Mobile checks ─── */
function initMobileChecks() {
  // Add mobile class to body for CSS targeting
  const isMobile = window.matchMedia('(max-width: 991.98px)').matches;
  if (isMobile) {
    document.body.classList.add('is-mobile');
  }

  // Listen for resize
  window.addEventListener('resize', debounce(() => {
    const isMobileNow = window.matchMedia('(max-width: 991.98px)').matches;
    document.body.classList.toggle('is-mobile', isMobileNow);
  }, 150));
}

/* ─── Table search/filter ─── */
function initTableSearch() {
  document.querySelectorAll('[data-table-search]').forEach(input => {
    const tableId = input.getAttribute('data-table-search');
    const table = document.getElementById(tableId);
    if (!table) return;

    input.addEventListener('input', debounce(() => {
      const term = input.value.toLowerCase().trim();
      const rows = table.querySelectorAll('tbody tr');

      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
      });
    }, 200));
  });
}

/* ─── File input display ─── */
function initFileInputs() {
  document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', () => {
      const label = input.closest('.form-file')?.querySelector('.form-file-label');
      if (label) {
        if (input.files.length > 0) {
          label.textContent = input.files[0].name;
          label.style.color = 'var(--primary)';
        } else {
          label.textContent = label.dataset.placeholder || 'Pilih file...';
          label.style.color = '';
        }
      }
    });
  });
}

/* ─── Fetch helpers ─── */
async function fetchData(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) throw new Error(`HTTP ${response.status}`);
    return await response.json();
  } catch (err) {
    console.error('Fetch error:', err);
    return null;
  }
}

/* ─── Toast notification ─── */
function showToast(message, type = 'info', duration = 3000) {
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
    <span class="alert-content">${message}</span>
    <button class="alert-close" style="background:none;border:none;cursor:pointer;margin-left:12px;color:inherit;">×</button>
  `;

  document.body.appendChild(toast);

  toast.querySelector('.alert-close').addEventListener('click', () => {
    toast.remove();
  });

  if (duration > 0) {
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100%)';
      setTimeout(() => toast.remove(), 300);
    }, duration);
  }
}

/* Slide-in animation for toast */
const toastStyle = document.createElement('style');
toastStyle.textContent = `
  @keyframes slideInRight {
    from { opacity: 0; transform: translateX(100%); }
    to { opacity: 1; transform: translateX(0); }
  }
`;
document.head.appendChild(toastStyle);
