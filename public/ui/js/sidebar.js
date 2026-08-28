/* ============================================================
   Sidebar Controller
   Toggle, overlay, active link highlight
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.querySelector('.sidebar');
  const overlay = document.querySelector('.sidebar-overlay');
  const toggleBtn = document.querySelector('.sidebar-toggle');

  // Toggle sidebar on mobile
  if (toggleBtn && sidebar && overlay) {
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('show');
      overlay.classList.toggle('show');
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.remove('show');
      overlay.classList.remove('show');
    });
  }

  // Highlight active nav link based on current page
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-link').forEach(link => {
    const href = link.getAttribute('href');
    if (href && (href === currentPage || href.endsWith(currentPage))) {
      link.classList.add('active');
      link.setAttribute('aria-current', 'page');
    }
  });

  // Auto-close sidebar on mobile when a nav link is clicked
  document.querySelectorAll('.sidebar .nav-link').forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth < 992 && sidebar && overlay) {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      }
    });
  });
});
