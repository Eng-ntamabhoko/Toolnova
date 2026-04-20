import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('percentageCalculator', () => ({
        valueA: '',
        valueB: '',
        percentValue: '',
        baseValue: '',
        partValue: '',
        oldValue: '',
        newValue: '',
        oldDecreaseValue: '',
        newDecreaseValue: '',
        results: {
            percentOf: null,
            whatPercent: null,
            increasePercent: null,
            decreasePercent: null,
        },
        error: '',
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What can this percentage calculator do?',
                a: 'It can calculate a percentage of a number, find what percent one number is of another, and calculate percentage increase or decrease.'
            },
            {
                q: 'Can I use this for discounts and marks?',
                a: 'Yes. It is useful for discounts, exam scores, growth rates, comparisons, profit changes and many everyday calculations.'
            },
            {
                q: 'What is the formula for percentage of a number?',
                a: 'The basic formula is percentage × total ÷ 100.'
            },
            {
                q: 'How do I know what percent one value is of another?',
                a: 'Divide the first value by the second value, then multiply by 100.'
            },
            {
                q: 'What is percentage increase?',
                a: 'Percentage increase shows how much a value has grown compared with the original value.'
            },
            {
                q: 'What is percentage decrease?',
                a: 'Percentage decrease shows how much a value has dropped compared with the original value.'
            },
            {
                q: 'Can I use decimals in this tool?',
                a: 'Yes. You can enter whole numbers or decimal values.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for students, business owners, shoppers, teachers, freelancers and anyone working with numbers.'
            }
        ],

        init() {
            this.$watch('valueA', () => this.calculatePercentOf());
            this.$watch('valueB', () => this.calculatePercentOf());

            this.$watch('partValue', () => this.calculateWhatPercent());
            this.$watch('baseValue', () => this.calculateWhatPercent());

            this.$watch('oldValue', () => this.calculateIncrease());
            this.$watch('newValue', () => this.calculateIncrease());

            this.$watch('oldDecreaseValue', () => this.calculateDecrease());
            this.$watch('newDecreaseValue', () => this.calculateDecrease());
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
                maximumFractionDigits: 4,
            });
        },

        calculatePercentOf() {
            const percent = this.parseNumber(this.valueA);
            const total = this.parseNumber(this.valueB);

            if (percent === null || total === null) {
                this.results.percentOf = null;
                return;
            }

            this.results.percentOf = (percent / 100) * total;
        },

        calculateWhatPercent() {
            const part = this.parseNumber(this.partValue);
            const whole = this.parseNumber(this.baseValue);

            if (part === null || whole === null || whole === 0) {
                this.results.whatPercent = null;
                return;
            }

            this.results.whatPercent = (part / whole) * 100;
        },

        calculateIncrease() {
            const oldVal = this.parseNumber(this.oldValue);
            const newVal = this.parseNumber(this.newValue);

            if (oldVal === null || newVal === null || oldVal === 0) {
                this.results.increasePercent = null;
                return;
            }

            this.results.increasePercent = ((newVal - oldVal) / oldVal) * 100;
        },

        calculateDecrease() {
            const oldVal = this.parseNumber(this.oldDecreaseValue);
            const newVal = this.parseNumber(this.newDecreaseValue);

            if (oldVal === null || newVal === null || oldVal === 0) {
                this.results.decreasePercent = null;
                return;
            }

            this.results.decreasePercent = ((oldVal - newVal) / oldVal) * 100;
        },

        clearAll() {
            this.valueA = '';
            this.valueB = '';
            this.percentValue = '';
            this.baseValue = '';
            this.partValue = '';
            this.oldValue = '';
            this.newValue = '';
            this.oldDecreaseValue = '';
            this.newDecreaseValue = '';
            this.results = {
                percentOf: null,
                whatPercent: null,
                increasePercent: null,
                decreasePercent: null,
            };
            this.error = '';
        },

        async shareTool() {
            const shareData = {
                title: 'Percentage Calculator - ToolNova',
                text: 'Calculate percentages quickly with this free Percentage Calculator tool.',
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