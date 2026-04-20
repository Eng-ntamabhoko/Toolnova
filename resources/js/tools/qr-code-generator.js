import Alpine from 'alpinejs';
import QRCode from 'qrcode';

document.addEventListener('alpine:init', () => {
    Alpine.data('qrCodeGenerator', () => ({
        text: '',
        size: 256,
        darkColor: '#111827',
        lightColor: '#ffffff',
        qrDataUrl: '',
        copied: false,
        error: '',
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What can I turn into a QR code?',
                a: 'You can generate a QR code for URLs, plain text, phone numbers, contact details, Wi-Fi text and other readable content.'
            },
            {
                q: 'Does the QR code update automatically?',
                a: 'Yes. The preview updates when you change the content, size or colors.'
            },
            {
                q: 'Can I download the QR code as an image?',
                a: 'Yes. You can download the generated QR code as a PNG image.'
            },
            {
                q: 'Can I create a QR code for a website link?',
                a: 'Yes. Paste the full website address and the tool will generate a scannable QR code.'
            },
            {
                q: 'Does this tool save my QR code data?',
                a: 'No. The QR code is generated in the browser from the content you enter.'
            },
            {
                q: 'Why is my QR code not appearing?',
                a: 'Usually this happens when the input field is empty or the QR library has not loaded properly.'
            },
            {
                q: 'Can I change QR code colors?',
                a: 'Yes. You can choose dark and light colors to match your design or branding.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for businesses, students, event organizers, marketers and anyone who wants to share information quickly.'
            }
        ],

        init() {
            this.$watch('text', () => this.autoGenerate());
            this.$watch('size', () => this.autoGenerate());
            this.$watch('darkColor', () => this.autoGenerate());
            this.$watch('lightColor', () => this.autoGenerate());
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        autoGenerate() {
            if (this.text.trim()) {
                this.generateQrCode();
            } else {
                this.qrDataUrl = '';
                this.error = '';
            }
        },

        async generateQrCode() {
            this.error = '';
            this.copied = false;

            if (!this.text.trim()) {
                this.qrDataUrl = '';
                this.error = 'Please enter text or a link first.';
                return;
            }

            try {
                this.qrDataUrl = await QRCode.toDataURL(this.text, {
                    width: Number(this.size),
                    margin: 2,
                    color: {
                        dark: this.darkColor,
                        light: this.lightColor,
                    },
                });
            } catch (error) {
                this.qrDataUrl = '';
                this.error = 'Unable to generate the QR code. Please try again.';
            }
        },

        clearAll() {
            this.text = '';
            this.size = 256;
            this.darkColor = '#111827';
            this.lightColor = '#ffffff';
            this.qrDataUrl = '';
            this.copied = false;
            this.error = '';
        },

        downloadQr() {
            if (!this.qrDataUrl) return;

            const link = document.createElement('a');
            link.href = this.qrDataUrl;
            link.download = 'toolnova-qr-code.png';
            link.click();
        },

        async copyText() {
            if (!this.text.trim()) return;

            try {
                await navigator.clipboard.writeText(this.text);
                this.copied = true;

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                this.error = 'Unable to copy the text.';
            }
        },

        async shareTool() {
            const shareData = {
                title: 'QR Code Generator - ToolNova',
                text: 'Generate QR codes quickly with this free QR Code Generator tool.',
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