document.querySelectorAll('.keranjang-form').forEach(form => {
        const min = form.querySelector('.kurang');
        const plus = form.querySelector('.tambah');
        const input = form.querySelector('.porsi-input');

        min.addEventListener('click', () => {
            let hasil = parseInt(input.value);
            if (hasil > 1) input.value = hasil - 1;
        });

        plus.addEventListener('click', () => {
            let hasil = parseInt(input.value);
            input.value = hasil + 1;
        });
});