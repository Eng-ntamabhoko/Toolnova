import Alpine from 'alpinejs';
import { ageSurvivalData } from '../data/age-survival-data';

document.addEventListener('alpine:init', () => {
    Alpine.data('ageCalculator', () => ({
        birthDate: '',
        asOfDate: '',
        sex: 'female',
        country: 'tanzania',
        error: '',
        resultReady: false,

        openHowTo: false,
        openFaq: null,
        copied: false,

        faqItems: [
            {
                q: 'Can this tool calculate hours and minutes too?',
                a: 'Yes. It calculates total days, hours, minutes and seconds lived between the selected dates.'
            },
            {
                q: 'Can I calculate age on another date?',
                a: 'Yes. Change the reference date to calculate age on another valid date after birth.'
            },
            {
                q: 'What does “Average Survival Outlook” mean?',
                a: 'It is a general population-based estimate. It should be treated as guidance based on average patterns, not as a personal or medical prediction.'
            },
            {
                q: 'Why is sex included in the form?',
                a: 'The survival outlook section changes slightly by sex because population averages often differ between male and female mortality patterns.'
            },
            {
                q: 'What is the difference between Tanzania mode and General mode?',
                a: 'Tanzania mode uses a locally tuned outlook for Tanzanian population averages, while General mode uses a broader average profile.'
            },
            {
                q: 'Does this tool save my information?',
                a: 'No. The calculator works in the browser and simply shows the results on the page.'
            },
            {
                q: 'Can I use this tool for school forms or applications?',
                a: 'Yes. It is useful for checking exact age, date-based age differences and other general record needs.'
            },
            {
                q: 'Are the lifespan estimates exact?',
                a: 'No. Exact scientific estimates require full life-table datasets by age and sex. This version gives a simplified average outlook.'
            }
        ],

        result: {
            years: null,
            months: null,
            days: null,
        },

        totals: {
            totalMonths: null,
            totalWeeks: null,
            totalDays: null,
            totalHours: null,
            totalMinutes: null,
            totalSeconds: null,
        },

        survival: {
            estimatedRemainingYears: null,
            estimatedLifespanAge: null,
            probReach60: null,
            probReach70: null,
            probReach80: null,
            probReach90: null,
        },

        birthWeekday: '',
        nextBirthdayDate: '',
        nextBirthdayWeekday: '',
        daysUntilBirthday: null,
        milestones: [],

        init() {
            this.asOfDate = this.formatDate(new Date());

            this.$watch('birthDate', () => this.autoCalculate());
            this.$watch('asOfDate', () => this.autoCalculate());
            this.$watch('sex', () => this.autoCalculate());
            this.$watch('country', () => this.autoCalculate());
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        formatDate(date) {
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        },

        autoCalculate() {
            if (this.birthDate && this.asOfDate) {
                this.calculate();
            }
        },

        resetForm() {
            this.birthDate = '';
            this.error = '';
            this.resultReady = false;
            this.openFaq = null;
            this.openHowTo = false;
            this.copied = false;

            this.result = { years: null, months: null, days: null };
            this.totals = {
                totalMonths: null,
                totalWeeks: null,
                totalDays: null,
                totalHours: null,
                totalMinutes: null,
                totalSeconds: null,
            };
            this.survival = {
                estimatedRemainingYears: null,
                estimatedLifespanAge: null,
                probReach60: null,
                probReach70: null,
                probReach80: null,
                probReach90: null,
            };
            this.birthWeekday = '';
            this.nextBirthdayDate = '';
            this.nextBirthdayWeekday = '';
            this.daysUntilBirthday = null;
            this.milestones = [];
            this.asOfDate = this.formatDate(new Date());
        },

        calculate() {
            this.error = '';

            if (!this.birthDate) {
                this.resultReady = false;
                return;
            }

            if (!this.asOfDate) {
                this.resultReady = false;
                return;
            }

            const birth = new Date(this.birthDate + 'T00:00:00');
            const asOf = new Date(this.asOfDate + 'T00:00:00');

            if (isNaN(birth.getTime()) || isNaN(asOf.getTime())) {
                this.error = 'Please enter valid dates.';
                this.resultReady = false;
                return;
            }

            if (birth > asOf) {
                this.error = 'Date of birth cannot be later than the selected calculation date.';
                this.resultReady = false;
                return;
            }

            this.result = this.calculateExactAge(birth, asOf);

            const diffMs = asOf.getTime() - birth.getTime();
            const totalDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
            const totalHours = Math.floor(diffMs / (1000 * 60 * 60));
            const totalMinutes = Math.floor(diffMs / (1000 * 60));
            const totalSeconds = Math.floor(diffMs / 1000);
            const totalWeeks = (totalDays / 7).toFixed(2);
            const totalMonths = (this.result.years * 12 + this.result.months + (this.result.days / 30.4375)).toFixed(2);

            this.totals = {
                totalMonths,
                totalWeeks,
                totalDays,
                totalHours,
                totalMinutes,
                totalSeconds,
            };

            this.birthWeekday = birth.toLocaleDateString('en-US', { weekday: 'long' });

            const nextBirthday = this.getNextBirthday(birth, asOf);
            this.nextBirthdayDate = nextBirthday.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });
            this.nextBirthdayWeekday = nextBirthday.toLocaleDateString('en-US', { weekday: 'long' });

            const birthdayDiffMs = nextBirthday.getTime() - asOf.getTime();
            this.daysUntilBirthday = Math.ceil(birthdayDiffMs / (1000 * 60 * 60 * 24));

            this.milestones = this.buildMilestones(totalDays, birth);
            this.survival = this.calculateSurvivalOutlook(this.result.years, this.sex, this.country);

            this.resultReady = true;
        },

        calculateExactAge(birth, asOf) {
            let years = asOf.getFullYear() - birth.getFullYear();
            let months = asOf.getMonth() - birth.getMonth();
            let days = asOf.getDate() - birth.getDate();

            if (days < 0) {
                months--;
                const previousMonth = new Date(asOf.getFullYear(), asOf.getMonth(), 0);
                days += previousMonth.getDate();
            }

            if (months < 0) {
                years--;
                months += 12;
            }

            return { years, months, days };
        },

        getNextBirthday(birth, asOf) {
            let year = asOf.getFullYear();
            let next = new Date(year, birth.getMonth(), birth.getDate());

            if (next <= asOf) {
                next = new Date(year + 1, birth.getMonth(), birth.getDate());
            }

            return next;
        },

        buildMilestones(totalDays, birth) {
            const targets = [10000, 20000, 25000];

            return targets.map((target) => {
                const hit = totalDays >= target;
                const milestoneDate = new Date(birth.getTime() + (target * 24 * 60 * 60 * 1000));

                return {
                    label: `${target.toLocaleString()} days`,
                    hit,
                    text: hit
                        ? `Reached on ${milestoneDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}.`
                        : `Expected on ${milestoneDate.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}.`,
                };
            });
        },

        calculateSurvivalOutlook(currentAge, sex, country) {
            const table = ageSurvivalData[country]?.[sex] || ageSurvivalData.general.female;

            const interpolate = (field) => {
                if (currentAge <= table[0].age) return table[0][field];
                if (currentAge >= table[table.length - 1].age) return table[table.length - 1][field];

                for (let i = 0; i < table.length - 1; i++) {
                    const a = table[i];
                    const b = table[i + 1];
                    if (currentAge >= a.age && currentAge <= b.age) {
                        const ratio = (currentAge - a.age) / (b.age - a.age);
                        return a[field] + (b[field] - a[field]) * ratio;
                    }
                }

                return table[table.length - 1][field];
            };

            const remaining = Math.max(0, interpolate('remaining'));
            const p60 = currentAge >= 60 ? 100 : Math.min(100, Math.max(0, interpolate('p60')));
            const p70 = currentAge >= 70 ? 100 : Math.min(100, Math.max(0, interpolate('p70')));
            const p80 = currentAge >= 80 ? 100 : Math.min(100, Math.max(0, interpolate('p80')));
            const p90 = currentAge >= 90 ? 100 : Math.min(100, Math.max(0, interpolate('p90')));

            return {
                estimatedRemainingYears: `${remaining.toFixed(1)} years`,
                estimatedLifespanAge: `${(currentAge + remaining).toFixed(1)} years`,
                probReach60: `${p60.toFixed(0)}%`,
                probReach70: `${p70.toFixed(0)}%`,
                probReach80: `${p80.toFixed(0)}%`,
                probReach90: `${p90.toFixed(0)}%`,
            };
        },

        buildShareText() {
            if (!this.resultReady) return '';

            return `Age Result:
Years: ${this.result.years}
Months: ${this.result.months}
Days: ${this.result.days}
Born on: ${this.birthWeekday}
Total days lived: ${this.totals.totalDays}
Total hours lived: ${this.totals.totalHours}
Next birthday: ${this.nextBirthdayDate}
Days until next birthday: ${this.daysUntilBirthday}`;
        },

        async copyResult() {
            if (!this.resultReady) return;

            try {
                await navigator.clipboard.writeText(this.buildShareText());
                this.copied = true;
                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                this.error = 'Unable to copy the result.';
            }
        },

        async shareResult() {
            if (!this.resultReady) return;

            const shareData = {
                title: 'Age Calculator Result - ToolNova',
                text: this.buildShareText(),
                url: window.location.href,
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    await this.copyResult();
                }
            } catch (error) {
                // user cancelled share, ignore
            }
        },

        printResult() {
            if (!this.resultReady) return;
            window.print();
        }
    }));
});