'use strict';

(function () {
    var filterBtns = document.querySelectorAll('.filter-btn');
    var grid       = document.getElementById('portfolio-grid');
    if (!filterBtns.length || !grid) return;

    var cards = grid.querySelectorAll('.project-card');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var filter = btn.dataset.filter;

            /* Update active button */
            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            /* Filter cards */
            var visible = 0;
            cards.forEach(function (card) {
                var cats = (card.dataset.category || '').split(' ');
                var show = filter === '*' || cats.indexOf(filter) !== -1;
                if (show) {
                    card.style.display = '';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            /* No-results message */
            var noResult = grid.querySelector('.no-results');
            if (visible === 0 && !noResult) {
                var msg = document.createElement('p');
                msg.className = 'no-results';
                msg.style.cssText = 'grid-column:1/-1;text-align:center;color:var(--gray);padding:60px 0';
                msg.textContent = 'Няма проекти в тази категория.';
                grid.appendChild(msg);
            } else if (visible > 0 && noResult) {
                noResult.remove();
            }
        });
    });
})();
