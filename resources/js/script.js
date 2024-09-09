

// Buat perpindahan tab di satuh alaman
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('#myTab a');
    tabs.forEach(tab => {
      tab.addEventListener('click', function (event) {
        event.preventDefault();
        tabs.forEach(t => t.classList.remove('border-b-2', 'border-green-500', 'text-green-700'));
        tab.classList.add('border-b-2', 'border-green-500', 'text-green-700');

        document.querySelectorAll('.tab-content > div').forEach(panel => panel.classList.add('hidden'));
        const activePanel = document.querySelector(tab.getAttribute('href'));
        activePanel.classList.remove('hidden');
      });
    });
});


