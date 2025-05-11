document.querySelectorAll('.keranjang-form').forEach(form => {
        const min = form.querySelector('.kurang');
        const plus = form.querySelector('.tambah');
        const input = form.querySelector('.porsi-input');

        min.addEventListener('click', () => {
            let hasil = parseInt(input.hasil);
            if (hasil > 1) input.hasil = hasil - 1;
        });

        plus.addEventListener('click', () => {
            let hasil = parseInt(input.hasil);
            input.hasil = hasil + 1;
        });
});