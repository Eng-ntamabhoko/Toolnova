import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('textCaseConverter', () => ({
        inputText: '',
        outputText: '',
        copied: false,
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this text case converter do?',
                a: 'It changes text into uppercase, lowercase, title case, sentence case and other useful writing styles.'
            },
            {
                q: 'Can I convert text instantly?',
                a: 'Yes. Just paste or type your text, then choose the case format you want.'
            },
            {
                q: 'What is title case?',
                a: 'Title case changes the first letter of each main word to uppercase, which is useful for headings and titles.'
            },
            {
                q: 'What is sentence case?',
                a: 'Sentence case makes the first letter of each sentence uppercase and keeps the rest of the sentence more natural.'
            },
            {
                q: 'Can I copy the converted result?',
                a: 'Yes. After conversion, you can copy the output with one click.'
            },
            {
                q: 'Does this tool save my text?',
                a: 'No. The text is processed in the browser and is not stored by the tool.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for writers, students, social media managers, marketers and anyone editing text.'
            },
            {
                q: 'Can I clear everything and start again?',
                a: 'Yes. The clear button removes both the input and output text.'
            }
        ],

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        toUppercase() {
            this.outputText = this.inputText.toUpperCase();
            this.copied = false;
        },

        toLowercase() {
            this.outputText = this.inputText.toLowerCase();
            this.copied = false;
        },

        toTitleCase() {
            this.outputText = this.inputText
                .toLowerCase()
                .split(/\s+/)
                .map(word => word ? word.charAt(0).toUpperCase() + word.slice(1) : '')
                .join(' ');
            this.copied = false;
        },

        toCapitalizeEachWord() {
            this.outputText = this.inputText.replace(/\b\w/g, char => char.toUpperCase());
            this.copied = false;
        },

        toSentenceCase() {
            const lower = this.inputText.toLowerCase();
            this.outputText = lower.replace(/(^\s*\w|[.!?]\s+\w)/g, char => char.toUpperCase());
            this.copied = false;
        },

        clearAll() {
            this.inputText = '';
            this.outputText = '';
            this.copied = false;
        },

        async copyOutput() {
            if (!this.outputText) return;

            try {
                await navigator.clipboard.writeText(this.outputText);
                this.copied = true;

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                // ignore
            }
        },

        async shareTool() {
            const shareData = {
                title: 'Text Case Converter - ToolNova',
                text: 'Convert text into uppercase, lowercase, title case and more with this free tool.',
                url: window.location.href,
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                }
            } catch (error) {
                // ignore
            }
        },

        get inputWords() {
            if (!this.inputText.trim()) return 0;
            return this.inputText.trim().split(/\s+/).filter(Boolean).length;
        },

        get inputCharacters() {
            return this.inputText.length;
        },

        get outputWords() {
            if (!this.outputText.trim()) return 0;
            return this.outputText.trim().split(/\s+/).filter(Boolean).length;
        },

        get outputCharacters() {
            return this.outputText.length;
        }
    }));
});