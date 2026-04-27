import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('passwordGenerator', () => ({
        length: 16,
        includeUppercase: true,
        includeLowercase: true,
        includeNumbers: true,
        includeSymbols: true,
        avoidSimilar: false,
        excludeAmbiguousSymbols: false,
        password: '',
        copied: false,
        error: '',
        strengthLabel: 'Strong',
        strengthWidth: 75,
        strengthColor: 'bg-emerald-500',
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this password generator do?',
                a: 'It creates random passwords using the options you choose, such as uppercase letters, lowercase letters, numbers and symbols.'
            },
            {
                q: 'Is the generated password secure?',
                a: 'It is designed to generate strong random passwords in the browser. Longer passwords with mixed character types are generally stronger.'
            },
            {
                q: 'Can I generate a password without symbols?',
                a: 'Yes. You can disable symbols and generate passwords using only letters and numbers.'
            },
            {
                q: 'What does “avoid similar characters” mean?',
                a: 'It removes characters that can be easily confused, such as O and 0, l and 1, or I and l.'
            },
            {
                q: 'What password length should I use?',
                a: 'For better security, many users prefer 12 to 20 characters or more, depending on where the password will be used.'
            },
            {
                q: 'Does this tool save my password?',
                a: 'No. The password is generated in the browser and is not saved by the tool.'
            },
            {
                q: 'Can I use this for social media, email and business accounts?',
                a: 'Yes. It can help generate passwords for personal, work and business use.'
            },
            {
                q: 'Why is my password strength different when I change options?',
                a: 'Strength depends on length and character variety. Short passwords or passwords using fewer character types are usually weaker.'
            }
        ],

        init() {
            this.generatePassword();

            this.$watch('length', () => this.generatePassword());
            this.$watch('includeUppercase', () => this.generatePassword());
            this.$watch('includeLowercase', () => this.generatePassword());
            this.$watch('includeNumbers', () => this.generatePassword());
            this.$watch('includeSymbols', () => this.generatePassword());
            this.$watch('avoidSimilar', () => this.generatePassword());
            this.$watch('excludeAmbiguousSymbols', () => this.generatePassword());
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        generatePassword() {
            this.error = '';
            this.copied = false;

            let uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let lowercase = 'abcdefghijklmnopqrstuvwxyz';
            let numbers = '0123456789';
            let symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?/~';
            const similarChars = /[O0Il1]/g;
            const ambiguousSymbols = /[{}[\]()/\\'"`,;:.<>]/g;

            if (this.avoidSimilar) {
                uppercase = uppercase.replace(similarChars, '');
                lowercase = lowercase.replace(similarChars, '');
                numbers = numbers.replace(similarChars, '');
            }

            if (this.excludeAmbiguousSymbols) {
                symbols = symbols.replace(ambiguousSymbols, '');
            }

            let charset = '';
            const guaranteedChars = [];

            if (this.includeUppercase) {
                charset += uppercase;
                guaranteedChars.push(this.randomChar(uppercase));
            }

            if (this.includeLowercase) {
                charset += lowercase;
                guaranteedChars.push(this.randomChar(lowercase));
            }

            if (this.includeNumbers) {
                charset += numbers;
                guaranteedChars.push(this.randomChar(numbers));
            }

            if (this.includeSymbols) {
                charset += symbols;
                guaranteedChars.push(this.randomChar(symbols));
            }

            if (!charset.length) {
                this.password = '';
                this.error = 'Please select at least one character type.';
                this.updateStrength();
                return;
            }

            let generated = [...guaranteedChars];

            while (generated.length < this.length) {
                generated.push(this.randomChar(charset));
            }

            this.password = this.shuffleArray(generated).join('');
            this.updateStrength();
        },

        randomChar(source) {
            if (!source.length) return '';
            const index = Math.floor(Math.random() * source.length);
            return source[index];
        },

        shuffleArray(array) {
            const arr = [...array];
            for (let i = arr.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [arr[i], arr[j]] = [arr[j], arr[i]];
            }
            return arr;
        },

        updateStrength() {
            let score = 0;

            if (this.length >= 8) score += 20;
            if (this.length >= 12) score += 20;
            if (this.length >= 16) score += 15;
            if (this.includeUppercase) score += 10;
            if (this.includeLowercase) score += 10;
            if (this.includeNumbers) score += 10;
            if (this.includeSymbols) score += 15;

            if (score < 40) {
                this.strengthLabel = 'Weak';
                this.strengthWidth = 30;
                this.strengthColor = 'bg-red-500';
            } else if (score < 70) {
                this.strengthLabel = 'Medium';
                this.strengthWidth = 60;
                this.strengthColor = 'bg-amber-500';
            } else if (score < 90) {
                this.strengthLabel = 'Strong';
                this.strengthWidth = 80;
                this.strengthColor = 'bg-blue-600';
            } else {
                this.strengthLabel = 'Very Strong';
                this.strengthWidth = 100;
                this.strengthColor = 'bg-emerald-500';
            }
        },

        async copyPassword() {
            if (!this.password) return;

            try {
                await navigator.clipboard.writeText(this.password);
                this.copied = true;

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                this.error = 'Unable to copy the password.';
            }
        },

        async sharePasswordTool() {
            const shareData = {
                title: 'Password Generator - ToolNova',
                text: 'Generate strong passwords with this free password generator tool.',
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