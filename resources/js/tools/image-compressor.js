import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('imageCompressor', () => ({
        originalFile: null,
        originalName: '',
        originalSize: 0,
        compressedSize: 0,
        quality: 80,
        outputFormat: 'jpeg',
        originalPreview: '',
        compressedPreview: '',
        compressedBlob: null,
        copied: false,
        error: '',
        processing: false,
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this image compressor do?',
                a: 'It reduces image file size in the browser to help with uploads, websites and sharing.'
            },
            {
                q: 'What image formats work best?',
                a: 'JPEG, JPG, PNG and WebP images usually work well with this tool.'
            },
            {
                q: 'Does the image leave my browser?',
                a: 'No. The compression happens in the browser on your device.'
            },
            {
                q: 'Can I control image quality?',
                a: 'Yes. You can adjust the quality slider to balance size and appearance.'
            },
            {
                q: 'Why is PNG sometimes not much smaller?',
                a: 'PNG files can behave differently from JPEG images, especially if they contain sharp graphics or transparency.'
            },
            {
                q: 'Can I download the compressed image?',
                a: 'Yes. After compression, you can download the result as a new image file.'
            },
            {
                q: 'Will compression reduce image quality?',
                a: 'In many cases yes, especially with lower quality settings, but it can greatly reduce file size.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for website owners, bloggers, students, designers, marketers and anyone sharing images online.'
            }
        ],

        init() {
            this.$watch('quality', () => {
                if (this.originalFile) this.compressImage();
            });

            this.$watch('outputFormat', () => {
                if (this.originalFile) this.compressImage();
            });
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        handleFileUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                this.error = 'Please upload a valid image file.';
                return;
            }

            this.error = '';
            this.originalFile = file;
            this.originalName = file.name;
            this.originalSize = file.size;
            this.compressedSize = 0;
            this.compressedBlob = null;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.originalPreview = e.target.result || '';
                this.compressImage();
            };
            reader.readAsDataURL(file);
        },

        async compressImage() {
            if (!this.originalPreview) return;

            this.processing = true;
            this.error = '';

            try {
                const img = new Image();
                img.onload = async () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    canvas.width = img.width;
                    canvas.height = img.height;

                    ctx.drawImage(img, 0, 0);

                    const mimeType = this.outputFormat === 'webp' ? 'image/webp' : 'image/jpeg';
                    const qualityValue = Number(this.quality) / 100;

                    canvas.toBlob(
                        (blob) => {
                            if (!blob) {
                                this.error = 'Unable to compress the image.';
                                this.processing = false;
                                return;
                            }

                            this.compressedBlob = blob;
                            this.compressedSize = blob.size;
                            this.compressedPreview = URL.createObjectURL(blob);
                            this.processing = false;
                        },
                        mimeType,
                        qualityValue
                    );
                };

                img.onerror = () => {
                    this.error = 'Unable to load the selected image.';
                    this.processing = false;
                };

                img.src = this.originalPreview;
            } catch (error) {
                this.error = 'An unexpected error occurred during compression.';
                this.processing = false;
            }
        },

        clearAll() {
            this.originalFile = null;
            this.originalName = '';
            this.originalSize = 0;
            this.compressedSize = 0;
            this.originalPreview = '';
            this.compressedPreview = '';
            this.compressedBlob = null;
            this.error = '';
            this.processing = false;
            this.quality = 80;
            this.outputFormat = 'jpeg';
        },

        downloadCompressed() {
            if (!this.compressedBlob) return;

            const extension = this.outputFormat === 'webp' ? 'webp' : 'jpg';
            const baseName = this.originalName.replace(/\.[^/.]+$/, '');
            const link = document.createElement('a');

            link.href = this.compressedPreview;
            link.download = `${baseName}-compressed.${extension}`;
            link.click();
        },

        formatBytes(bytes) {
            if (!bytes) return '0 B';

            const units = ['B', 'KB', 'MB', 'GB'];
            let size = bytes;
            let unitIndex = 0;

            while (size >= 1024 && unitIndex < units.length - 1) {
                size /= 1024;
                unitIndex++;
            }

            return `${size.toFixed(size >= 10 ? 0 : 1)} ${units[unitIndex]}`;
        },

        get savedPercent() {
            if (!this.originalSize || !this.compressedSize) return 0;
            const saved = ((this.originalSize - this.compressedSize) / this.originalSize) * 100;
            return saved > 0 ? saved.toFixed(1) : 0;
        },

        async shareTool() {
            const shareData = {
                title: 'Image Compressor - ToolNova',
                text: 'Compress images online with this free Image Compressor tool.',
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