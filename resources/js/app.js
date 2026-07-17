const menuButton = document.querySelector('#menuButton');
const mobileMenu = document.querySelector('#mobileMenu');

menuButton?.addEventListener('click', () => {
    const isOpen = !mobileMenu.classList.contains('hidden');
    mobileMenu.classList.toggle('hidden');
    menuButton.setAttribute('aria-expanded', String(!isOpen));
});

mobileMenu?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
});

const sellPhoneForm = document.querySelector('#sellPhoneForm');

sellPhoneForm?.addEventListener('submit', (event) => {
    event.preventDefault();

    const value = (selector) => document.querySelector(selector).value;
    const accessories =
        [...document.querySelectorAll('input[name="accessories"]:checked')].map((input) => input.value).join(', ') ||
        '-';
    const message = [
        'Halo SecondByMePhone, saya ingin menjual iPhone:',
        '',
        `Nama: ${value('#sellerName')}`,
        `Seri: ${value('#phoneSeries')}`,
        `Kapasitas: ${value('#sellStorage')}`,
        `Battery Health: ${value('#batteryHealth')}%`,
        `Kondisi: ${value('#condition')}`,
        `Kelengkapan: ${accessories}`,
        `Minus/Catatan: ${value('#issueNotes') || '-'}`,
        `Harga yang diharapkan: ${value('#expectedPrice') || '-'}`,
    ].join('\n');

    window.open(`https://wa.me/6281222621419?text=${encodeURIComponent(message)}`, '_blank');
});

document.querySelectorAll('.gallery-thumb').forEach((button) => {
    button.addEventListener('click', () => {
        const mainImage = document.querySelector('#mainImage');
        if (!mainImage) return;

        mainImage.src = button.dataset.image;
        document.querySelectorAll('.gallery-thumb').forEach((thumbnail) => {
            thumbnail.classList.remove('border-blue-600');
        });
        button.classList.add('border-blue-600');
    });
});

const orderButton = document.querySelector('#orderButton');

if (orderButton) {
    const variants = (window.productVariants || []).map((variant) => ({
        ...variant,
        price: Number(variant.price),
        stock: Number(variant.stock),
    }));
    const capacityOptions = document.querySelector('#capacityOptions');
    const colorOptions = document.querySelector('#colorOptions');
    const selectedColorLabel = document.querySelector('#selectedColor');
    const priceLabel = document.querySelector('#productPrice');
    const stockBadge = document.querySelector('#stockBadge');
    const stockText = document.querySelector('#variantStockText');
    const quantityLabel = document.querySelector('#quantity');
    const selectionWarning = document.querySelector('#selectionWarning');

    let selectedVariant = null;
    let quantity = 1;

    const colorHex = {
        Black: '#111827',
        White: '#f8fafc',
        'Space Gray': '#4b5563',
        Silver: '#d1d5db',
        Gold: '#d4af77',
        Midnight: '#172033',
        Starlight: '#f4eadc',
        Blue: '#3b82f6',
        'Sierra Blue': '#9bb5ce',
        'Pacific Blue': '#1f4e6d',
        Purple: '#8b5cf6',
        'Deep Purple': '#4c3b5c',
        Pink: '#f9a8d4',
        Red: '#ef4444',
        Green: '#4d7c65',
        Yellow: '#facc15',
        Coral: '#ff7f66',
        'Midnight Green': '#405b52',
        'Natural Titanium': '#a89f91',
        'Blue Titanium': '#45566b',
        'White Titanium': '#d6d3ce',
        'Black Titanium': '#343434',
    };

    const formatMoney = (amount) => `Rp ${amount.toLocaleString('id-ID')}`;

    function updateQuantity(nextQuantity) {
        const maximum = Math.max(selectedVariant?.stock || 1, 1);
        quantity = Math.min(Math.max(nextQuantity, 1), maximum);
        quantityLabel.textContent = quantity;
    }

    function selectVariant(variant, button) {
        selectedVariant = variant;
        updateQuantity(1);

        colorOptions.querySelectorAll('button').forEach((option) => {
            option.classList.remove('border-blue-600', 'bg-blue-50', 'ring-2', 'ring-blue-100');
        });
        button.classList.add('border-blue-600', 'bg-blue-50', 'ring-2', 'ring-blue-100');

        selectedColorLabel.textContent = `— ${variant.color}`;
        priceLabel.textContent = formatMoney(variant.price);
        stockBadge.textContent = variant.stock > 0 ? `Stok varian ${variant.stock}` : 'Stok varian habis';
        stockBadge.classList.toggle('bg-emerald-500', variant.stock > 0);
        stockBadge.classList.toggle('bg-red-500', variant.stock < 1);
        stockText.textContent = `${variant.storage} · ${variant.color}: ${variant.stock} unit tersedia`;

        orderButton.disabled = variant.stock < 1;
        orderButton.classList.toggle('cursor-not-allowed', variant.stock < 1);
        orderButton.classList.toggle('opacity-50', variant.stock < 1);
        selectionWarning.classList.add('hidden');
    }

    function renderColors(storage) {
        const matchingVariants = variants.filter((variant) => variant.storage === storage);
        colorOptions.replaceChildren();
        selectedVariant = null;

        matchingVariants.forEach((variant) => {
            const button = document.createElement('button');
            const swatch = document.createElement('span');
            const label = document.createElement('span');

            button.type = 'button';
            button.className =
                'flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-left text-xs font-bold transition hover:border-blue-500';
            button.title = `${variant.color} — stok ${variant.stock}`;
            button.classList.toggle('opacity-50', variant.stock < 1);

            swatch.className = 'h-5 w-5 rounded-full border-2 border-white shadow ring-1 ring-slate-200';
            swatch.style.backgroundColor = colorHex[variant.color] || '#64748b';
            label.textContent = `${variant.color} · ${variant.stock} unit`;

            button.append(swatch, label);
            button.addEventListener('click', () => selectVariant(variant, button));
            colorOptions.append(button);
        });

        const preferredIndex = Math.max(
            0,
            matchingVariants.findIndex((variant) => variant.stock > 0),
        );
        colorOptions.children[preferredIndex]?.click();
    }

    function renderCapacities() {
        const storages = [...new Set(variants.map((variant) => variant.storage))].sort(
            (first, second) => Number.parseInt(first) - Number.parseInt(second),
        );

        capacityOptions.replaceChildren();
        storages.forEach((storage) => {
            const totalStock = variants
                .filter((variant) => variant.storage === storage)
                .reduce((total, variant) => total + variant.stock, 0);
            const button = document.createElement('button');

            button.type = 'button';
            button.className =
                'capacity-option rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold transition hover:border-blue-600';
            button.textContent = `${storage} · ${totalStock} unit`;
            button.classList.toggle('opacity-50', totalStock < 1);
            button.addEventListener('click', () => {
                capacityOptions.querySelectorAll('button').forEach((option) => {
                    option.classList.remove('border-blue-600', 'bg-blue-50', 'text-blue-700');
                });
                button.classList.add('border-blue-600', 'bg-blue-50', 'text-blue-700');
                selectedColorLabel.textContent = '— pilih warna';
                renderColors(storage);
            });
            capacityOptions.append(button);
        });

        const preferredVariant = variants.find((variant) => variant.stock > 0) || variants[0];
        const preferredButton = storages.indexOf(preferredVariant?.storage);
        capacityOptions.children[Math.max(preferredButton, 0)]?.click();
    }

    document.querySelector('#minusQty')?.addEventListener('click', () => updateQuantity(quantity - 1));
    document.querySelector('#plusQty')?.addEventListener('click', () => updateQuantity(quantity + 1));

    orderButton.addEventListener('click', () => {
        if (!selectedVariant || selectedVariant.stock < 1) {
            selectionWarning.classList.remove('hidden');
            return;
        }

        const message = [
            'Halo SecondByMePhone, saya ingin memesan:',
            '',
            `Produk: ${orderButton.dataset.name}`,
            `Kapasitas: ${selectedVariant.storage}`,
            `Warna: ${selectedVariant.color}`,
            `Harga: ${formatMoney(selectedVariant.price)}`,
            `Jumlah: ${quantity}`,
        ].join('\n');

        window.open(`https://wa.me/6281222621419?text=${encodeURIComponent(message)}`, '_blank');
    });

    if (variants.length > 0) {
        renderCapacities();
    } else {
        stockBadge.textContent = 'Stok varian habis';
        stockBadge.classList.replace('bg-emerald-500', 'bg-red-500');
        stockText.textContent = 'Belum ada varian aktif yang tersedia.';
        orderButton.disabled = true;
        orderButton.classList.add('cursor-not-allowed', 'opacity-50');
    }
}
