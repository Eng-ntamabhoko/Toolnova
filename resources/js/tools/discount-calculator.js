import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('discountCalculator', () => ({
        originalPrice: '',
        discountPercent: '',
        taxPercent: '',
        salePrice: '',
        reverseDiscountPercent: '',

        results: {
            discountAmount: null,
            finalPrice: null,
            finalPriceWithTax: null,
            taxAmount: null,
            originalFromSale: null,
            savingsPercent: null,
        },

        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this discount calculator do?',
                a: 'It calculates discount amount, final price after discount, price after tax and can also estimate original price from a sale price.'
            },
            {
                q: 'Can I use this for shopping and business pricing?',
                a: 'Yes. It works well for shopping discounts, promotions, invoices, offers and pricing comparisons.'
            },
            {
                q: 'What is discount amount?',
                a: 'Discount amount is the actual money reduced from the original price.'
            },
            {
                q: 'What is final price after discount?',
                a: 'It is the amount you pay after the discount has been subtracted from the original price.'
            },
            {
                q: 'Can I add tax after discount?',
                a: 'Yes. This tool can estimate the final total after applying both discount and tax.'
            },
            {
                q: 'Can I calculate the original price from a sale price?',
                a: 'Yes. Enter the sale price and discount percent in the reverse calculator section.'
            },
            {
                q: 'Can I use decimal values?',
                a: 'Yes. You can enter prices and percentages with decimals.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for shoppers, shop owners, freelancers, students, sales teams and anyone comparing prices.'
            }
        ],

        init() {
            this.$watch('originalPrice', () => this.calculateForward());
            this.$watch('discountPercent', () => this.calculateForward());
            this.$watch('taxPercent', () => this.calculateForward());

            this.$watch('salePrice', () => this.calculateReverse());
            this.$watch('reverseDiscountPercent', () => this.calculateReverse());
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        parseNumber(value) {
            if (value === '' || value === null || value === undefined) return null;
            const parsed = Number(value);
            return Number.isFinite(parsed) ? parsed : null;
        },

        formatNumber(value) {
            if (value === null || value === undefined || Number.isNaN(value)) return '--';
            return Number(value).toLocaleString(undefined, {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2,
            });
        },

        calculateForward() {
            const price = this.parseNumber(this.originalPrice);
            const discount = this.parseNumber(this.discountPercent);
            const tax = this.parseNumber(this.taxPercent);

            if (price === null || discount === null) {
                this.results.discountAmount = null;
                this.results.finalPrice = null;
                this.results.finalPriceWithTax = null;
                this.results.taxAmount = null;
                this.results.savingsPercent = null;
                return;
            }

            const discountAmount = (price * discount) / 100;
            const finalPrice = price - discountAmount;

            let taxAmount = null;
            let finalPriceWithTax = null;

            if (tax !== null) {
                taxAmount = (finalPrice * tax) / 100;
                finalPriceWithTax = finalPrice + taxAmount;
            }

            this.results.discountAmount = discountAmount;
            this.results.finalPrice = finalPrice;
            this.results.taxAmount = taxAmount;
            this.results.finalPriceWithTax = finalPriceWithTax;
            this.results.savingsPercent = discount;
        },

        calculateReverse() {
            const sale = this.parseNumber(this.salePrice);
            const discount = this.parseNumber(this.reverseDiscountPercent);

            if (sale === null || discount === null || discount >= 100) {
                this.results.originalFromSale = null;
                return;
            }

            const original = sale / (1 - discount / 100);
            this.results.originalFromSale = original;
        },

        clearAll() {
            this.originalPrice = '';
            this.discountPercent = '';
            this.taxPercent = '';
            this.salePrice = '';
            this.reverseDiscountPercent = '';

            this.results = {
                discountAmount: null,
                finalPrice: null,
                finalPriceWithTax: null,
                taxAmount: null,
                originalFromSale: null,
                savingsPercent: null,
            };
        },

        async shareTool() {
            const shareData = {
                title: 'Discount Calculator - ToolNova',
                text: 'Calculate discounts, sale prices and final totals with this free Discount Calculator.',
                url: window.location.href,
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                }
            } catch (error) {
                // ignore
            }
        }
    }));
});