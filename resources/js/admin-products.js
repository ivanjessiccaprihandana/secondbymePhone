const rowsContainer = document.querySelector('#variantRows');
const variantTemplate = document.querySelector('#variantTemplate');
const addVariantButton = document.querySelector('#addVariant');

function removeVariant(event) {
    const rows = document.querySelectorAll('.variant-row');

    if (rows.length > 1) {
        event.currentTarget.closest('.variant-row').remove();
    }
}

function bindRemoveButtons(container = document) {
    container.querySelectorAll('.remove-variant').forEach((button) => {
        button.removeEventListener('click', removeVariant);
        button.addEventListener('click', removeVariant);
    });
}

function addVariant() {
    const index = Date.now();
    const fragment = variantTemplate.content.cloneNode(true);

    fragment.querySelectorAll('[data-field]').forEach((element) => {
        const field = element.dataset.field.replace('_hidden', '');
        element.name = `variants[${index}][${field}]`;
    });

    rowsContainer.append(fragment);
    bindRemoveButtons(rowsContainer);
}

addVariantButton?.addEventListener('click', addVariant);
bindRemoveButtons();
