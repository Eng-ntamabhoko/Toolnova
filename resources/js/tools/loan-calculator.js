import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('loanCalculator', () => ({
        loanAmount: '',
        annualInterestRate: '',
        loanYears: '',
        extraMonthlyPayment: '',

        results: {
            monthlyPayment: null,
            monthlyPaymentWithExtra: null,
            totalPayment: null,
            totalInterest: null,
            totalPaymentWithExtra: null,
            totalInterestWithExtra: null,
            estimatedMonthsWithExtra: null,
        },

        schedulePreview: [],
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this loan calculator do?',
                a: 'It estimates monthly payment, total repayment, total interest and the effect of adding extra monthly payments.'
            },
            {
                q: 'Can I use this for personal loans and business loans?',
                a: 'Yes. It is useful for personal loans, business loans, school fee loans, equipment loans and similar repayment plans.'
            },
            {
                q: 'What interest rate should I enter?',
                a: 'Enter the annual interest rate provided by the lender, bank or financing agreement.'
            },
            {
                q: 'What happens if I add extra monthly payment?',
                a: 'An extra monthly payment can reduce the total interest paid and may shorten the repayment period.'
            },
            {
                q: 'Does this tool show exact bank repayment figures?',
                a: 'It gives a strong estimate, but actual lender schedules may differ slightly because of fees, insurance or lender-specific rules.'
            },
            {
                q: 'Can I use decimal values?',
                a: 'Yes. You can enter decimal values for amount, interest rate and extra payment.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for borrowers, students, employees, freelancers, business owners and anyone planning repayments.'
            },
            {
                q: 'What is total interest?',
                a: 'Total interest is the amount paid above the original loan amount over the life of the loan.'
            }
        ],

        init() {
            this.$watch('loanAmount', () => this.calculateLoan());
            this.$watch('annualInterestRate', () => this.calculateLoan());
            this.$watch('loanYears', () => this.calculateLoan());
            this.$watch('extraMonthlyPayment', () => this.calculateLoan());
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

        calculateLoan() {
            const principal = this.parseNumber(this.loanAmount);
            const annualRate = this.parseNumber(this.annualInterestRate);
            const years = this.parseNumber(this.loanYears);
            const extra = this.parseNumber(this.extraMonthlyPayment) || 0;

            this.schedulePreview = [];

            if (
                principal === null ||
                annualRate === null ||
                years === null ||
                principal <= 0 ||
                years <= 0 ||
                annualRate < 0
            ) {
                this.results = {
                    monthlyPayment: null,
                    monthlyPaymentWithExtra: null,
                    totalPayment: null,
                    totalInterest: null,
                    totalPaymentWithExtra: null,
                    totalInterestWithExtra: null,
                    estimatedMonthsWithExtra: null,
                };
                return;
            }

            const monthlyRate = annualRate / 100 / 12;
            const numberOfPayments = years * 12;

            let monthlyPayment;

            if (monthlyRate === 0) {
                monthlyPayment = principal / numberOfPayments;
            } else {
                monthlyPayment =
                    (principal * monthlyRate * Math.pow(1 + monthlyRate, numberOfPayments)) /
                    (Math.pow(1 + monthlyRate, numberOfPayments) - 1);
            }

            const totalPayment = monthlyPayment * numberOfPayments;
            const totalInterest = totalPayment - principal;

            let monthlyPaymentWithExtra = monthlyPayment + extra;
            let balance = principal;
            let months = 0;
            let totalPaidWithExtra = 0;
            let totalInterestWithExtra = 0;

            while (balance > 0 && months < 1200) {
                const interestPortion = monthlyRate === 0 ? 0 : balance * monthlyRate;
                let principalPortion = monthlyPaymentWithExtra - interestPortion;

                if (principalPortion <= 0) {
                    break;
                }

                if (principalPortion > balance) {
                    principalPortion = balance;
                }

                const actualPayment = principalPortion + interestPortion;
                balance -= principalPortion;
                months++;
                totalPaidWithExtra += actualPayment;
                totalInterestWithExtra += interestPortion;

                if (months <= 6) {
                    this.schedulePreview.push({
                        month: months,
                        payment: actualPayment,
                        principal: principalPortion,
                        interest: interestPortion,
                        balance: Math.max(balance, 0),
                    });
                }
            }

            this.results = {
                monthlyPayment,
                monthlyPaymentWithExtra: extra > 0 ? monthlyPaymentWithExtra : null,
                totalPayment,
                totalInterest,
                totalPaymentWithExtra: extra > 0 ? totalPaidWithExtra : null,
                totalInterestWithExtra: extra > 0 ? totalInterestWithExtra : null,
                estimatedMonthsWithExtra: extra > 0 ? months : null,
            };
        },

        clearAll() {
            this.loanAmount = '';
            this.annualInterestRate = '';
            this.loanYears = '';
            this.extraMonthlyPayment = '';
            this.schedulePreview = [];
            this.results = {
                monthlyPayment: null,
                monthlyPaymentWithExtra: null,
                totalPayment: null,
                totalInterest: null,
                totalPaymentWithExtra: null,
                totalInterestWithExtra: null,
                estimatedMonthsWithExtra: null,
            };
        },

        async shareTool() {
            const shareData = {
                title: 'Loan Calculator - ToolNova',
                text: 'Estimate monthly payments and total interest with this free Loan Calculator.',
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