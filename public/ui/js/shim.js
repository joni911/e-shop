/**
 * Shim.js — Kompatibilitas Bootstrap 4 → Bootstrap 5 (M4 PRD_UI_MIGRATION)
 *
 * Blade lama memakai atribut BS4: data-toggle="modal", data-target="#id", data-dismiss.
 * Bootstrap 5 memakai: data-bs-toggle, data-bs-target, data-bs-dismiss.
 * Shim ini menyalin nilai lama ke atribut baru & meng-init modal/alert BS5.
 */
(function () {
  'use strict';

  function convert(el) {
    if (!el || el.dataset.__shimmed) return;
    var t = el.getAttribute('data-toggle');
    var g = el.getAttribute('data-target');
    var d = el.getAttribute('data-dismiss');

    if (t) {
      if (t === 'modal') el.setAttribute('data-bs-toggle', 'modal');
      else if (t === 'collapse') el.setAttribute('data-bs-toggle', 'collapse');
      else if (t === 'tab') el.setAttribute('data-bs-toggle', 'tab');
      else if (t === 'dropdown') el.setAttribute('data-bs-toggle', 'dropdown');
      else el.setAttribute('data-bs-toggle', t);
    }
    if (g) el.setAttribute('data-bs-target', g);
    if (d) el.setAttribute('data-bs-dismiss', d);

    el.dataset.__shimmed = '1';
  }

  function convertAll(root) {
    var els = (root || document).querySelectorAll('[data-toggle],[data-target],[data-dismiss]');
    Array.prototype.forEach.call(els, convert);
  }

  function initModals(root) {
    // Init semua modal BS5 yang ada di DOM agar bisa dibuka via data atribut
    var modals = (root || document).querySelectorAll('.modal');
    Array.prototype.forEach.call(modals, function (m) {
      if (!m.__bsModal && window.bootstrap && window.bootstrap.Modal) {
        try {
          m.__bsModal = new window.bootstrap.Modal(m);
        } catch (e) { /* abaikan */ }
      }
    });
  }

  // Jalankan saat DOM siap
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      convertAll(document);
      initModals(document);
    });
  } else {
    convertAll(document);
    initModals(document);
  }

  // Untuk konten yang di-inject setelah load (modal dinamis, dll)
  document.addEventListener('DOMNodeInserted', function (e) {
    if (e.target && e.target.querySelectorAll) {
      convertAll(e.target);
      initModals(e.target);
    }
  });

  // Ekspos ke global
  window.UIShim = { convertAll: convertAll, initModals: initModals };
})();
