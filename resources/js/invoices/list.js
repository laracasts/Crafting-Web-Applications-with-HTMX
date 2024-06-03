let usd = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD'
});

Alpine.data('invoiceList', () => ({
    count: 0,
    total: 0,
    change(toggle, amount) {
        if (toggle) {
            this.count++;
            this.total += amount;
        } else {
            this.count--;
            this.total -= amount;
        }
    },
    get formatTotal() {
        return usd.format(this.total);
    }
}));

document.addEventListener('somethingSpecial', (e) => {
    alert('We received something special');
});

document.addEventListener('somethingElse', (e) => {
    document.getElementById('change-content').innerHTML = e.detail.message;
});