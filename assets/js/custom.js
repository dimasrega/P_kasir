const price_label = document.querySelectorAll('.price-label');
if (price_label != undefined) {
    price_label.forEach(price => {
        let containMin = false;
        let priceCount = price.textContent;
        if (priceCount.includes('-')) {
            priceCount = priceCount.replace('-', '');
            containMin = true;
        };
        let flipIt = priceCount.split('').reverse().join('');
        let final;
        for (let i = 0; i < priceCount.length; i += 3) {
            let result = flipIt.substring(i, i + 3) + '.';
            final += result;

            if (i >= priceCount.length - 3) {
                let removeDot = final.split('').reverse().join('').replace('denifednu', '');
                if (containMin == true) {
                    price.textContent = '-' + removeDot.substr(1, removeDot.length);
                } else {
                    price.textContent = removeDot.substr(1, removeDot.length);
                };
            }
        };
    });
};

const input_code = document.querySelectorAll('.enter-prevent');
if (input_code[0] != undefined) {
    input_code.forEach(input => {
        input.addEventListener(
            'keydown', function (e) {
                if (e.keyCode == '13') {
                    if (input.classList.contains('punya-kasir')) {
                        e.preventDefault();
                        window.location.href = `scan_code/${input.value}`;
                    } else {
                        e.preventDefault();
                    };
                };
            }
        );
    });
};