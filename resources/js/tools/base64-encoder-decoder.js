import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('base64Tool', () => ({
        inputText: '',
        outputText: '',
        mode: 'encode',
        copied: false,
        error: '',
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this Base64 tool do?',
                a: 'It converts normal text into Base64 and can also decode Base64 back into readable text.'
            },
            {
                q: 'What is Base64 used for?',
                a: 'Base64 is often used to encode text or data for transfer in systems that expect plain text formats.'
            },
            {
                q: 'Can I decode Base64 back into normal text?',
                a: 'Yes. Switch to decode mode and paste the Base64 value to convert it back.'
            },
            {
                q: 'Why am I seeing an invalid Base64 error?',
                a: 'This usually means the pasted value is incomplete, damaged or not a valid Base64 string.'
            },
            {
                q: 'Does this tool save my text?',
                a: 'No. The conversion happens in the browser and is not stored by the tool.'
            },
            {
                q: 'Can I use symbols and special characters?',
                a: 'Yes. This tool supports regular text input including many special characters through UTF-8 handling.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for developers, students, testers and anyone working with encoded text data.'
            },
            {
                q: 'Can I copy the result?',
                a: 'Yes. After converting, you can copy the output with one click.'
            }
        ],

        init() {
            this.$watch('inputText', () => this.process());
            this.$watch('mode', () => this.process());
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        process() {
            this.error = '';
            this.copied = false;

            if (!this.inputText) {
                this.outputText = '';
                return;
            }

            try {
                if (this.mode === 'encode') {
                    this.outputText = this.encodeUtf8ToBase64(this.inputText);
                } else {
                    this.outputText = this.decodeBase64ToUtf8(this.inputText);
                }
            } catch (error) {
                this.outputText = '';
                this.error = this.mode === 'decode'
                    ? 'Invalid Base64 input. Please check the value and try again.'
                    : 'Unable to encode the current text.';
            }
        },

        encodeUtf8ToBase64(text) {
            const utf8Bytes = new TextEncoder().encode(text);
            let binary = '';
            utf8Bytes.forEach(byte => {
                binary += String.fromCharCode(byte);
            });
            return btoa(binary);
        },

        decodeBase64ToUtf8(base64) {
            const cleaned = base64.trim();
            const binary = atob(cleaned);
            const bytes = Uint8Array.from(binary, char => char.charCodeAt(0));
            return new TextDecoder().decode(bytes);
        },

        clearAll() {
            this.inputText = '';
            this.outputText = '';
            this.error = '';
            this.copied = false;
        },

        swapMode() {
            this.mode = this.mode === 'encode' ? 'decode' : 'encode';
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
                this.error = 'Unable to copy the output.';
            }
        },

        async shareTool() {
            const shareData = {
                title: 'Base64 Encoder / Decoder - ToolNova',
                text: 'Encode and decode Base64 text online with this free tool.',
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

        get inputCharacters() {
            return this.inputText.length;
        },

        get outputCharacters() {
            return this.outputText.length;
        }
    }));
});