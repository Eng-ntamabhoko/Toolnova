import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('imageResizer', () => ({
        originalFile: null,
        originalName: '',
        originalSize: 0,
        originalWidth: 0,
        originalHeight: 0,
        width: '',
        height: '',
        keepAspectRatio: true,
        outputFormat: 'jpeg',
        originalPreview: '',
        resizedPreview: '',
        resizedBlob: null,
        resizedSize: 0,
        aspectRatio: 1,
        processing: false,
        error: '',
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this image resizer do?',
                a: 'It changes image dimensions in the browser so you can create a smaller or larger version for websites, uploads and design tasks.'
            },
            {
                q: 'Can I keep the image proportions?',
                a: 'Yes. Keep Aspect Ratio helps maintain the original proportions while changing width or height.'
            },
            {
                q: 'Can I resize an image without uploading it to a server?',
                a: 'Yes. This tool resizes the image directly in the browser on your device.'
            },
            {
                q: 'What formats can I export?',
                a: 'You can export resized images as JPEG or WebP in this version.'
            },
            {
                q: 'Can I choose preset sizes?',
                a: 'Yes. You can use common preset dimensions to resize quickly.'
            },
            {
                q: 'Will resizing affect image quality?',
                a: 'It can, especially when changing size significantly or exporting to compressed formats.'
            },
            {
                q: 'Can I download the resized image?',
                a: 'Yes. After resizing, you can download the output image.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for website owners, students, content creators, marketers and anyone preparing images for digital use.'
            }
        ],

        init() {
            this.$watch('width', (value) => {
                if (this.keepAspectRatio && this.originalWidth && this.originalHeight && document.activeElement?.id === 'resizeWidth') {
                    const newHeight = Math.round(Number(value || 0) / this.aspectRatio);
                    this.height = newHeight > 0 ? newHeight : '';
                }
            });

            this.$watch('height', (value) => {
                if (this.keepAspectRatio && this.originalWidth && this.originalHeight && document.activeElement?.id === 'resizeHeight') {
                    const newWidth = Math.round(Number(value || 0) * this.aspectRatio);
                    this.width = newWidth > 0 ? newWidth : '';
                }
            });

            this.$watch('outputFormat', () => {
                if (this.originalFile && this.width && this.height) this.resizeImage();
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
            this.resizedBlob = null;
            this.resizedPreview = '';
            this.resizedSize = 0;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.originalPreview = e.target.result || '';

                const img = new Image();
                img.onload = () => {
                    this.originalWidth = img.width;
                    this.originalHeight = img.height;
                    this.aspectRatio = img.width / img.height;
                    this.width = img.width;
                    this.height = img.height;
                };
                img.src = this.originalPreview;
            };
            reader.readAsDataURL(file);
        },

        applyPreset(presetWidth, presetHeight) {
            this.keepAspectRatio = false;
            this.width = presetWidth;
            this.height = presetHeight;

            if (this.originalFile) {
                this.resizeImage();
            }
        },

        async resizeImage() {
            if (!this.originalPreview) {
                this.error = 'Please upload an image first.';
                return;
            }

            if (!this.width || !this.height || Number(this.width) <= 0 || Number(this.height) <= 0) {
                this.error = 'Please enter valid width and height values.';
                return;
            }

            this.processing = true;
            this.error = '';

            try {
                const img = new Image();

                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    canvas.width = Number(this.width);
                    canvas.height = Number(this.height);

                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                    const mimeType = this.outputFormat === 'webp' ? 'image/webp' : 'image/jpeg';

                    canvas.toBlob(
                        (blob) => {
                            if (!blob) {
                                this.error = 'Unable to resize the image.';
                                this.processing = false;
                                return;
                            }

                            this.resizedBlob = blob;
                            this.resizedSize = blob.size;
                            this.resizedPreview = URL.createObjectURL(blob);
                            this.processing = false;
                        },
                        mimeType,
                        0.92
                    );
                };

                img.onerror = () => {
                    this.error = 'Unable to load the selected image.';
                    this.processing = false;
                };

                img.src = this.originalPreview;
            } catch (error) {
                this.error = 'An unexpected error occurred during resizing.';
                this.processing = false;
            }
        },

        clearAll() {
            this.originalFile = null;
            this.originalName = '';
            this.originalSize = 0;
            this.originalWidth = 0;
            this.originalHeight = 0;
            this.width = '';
            this.height = '';
            this.keepAspectRatio = true;
            this.outputFormat = 'jpeg';
            this.originalPreview = '';
            this.resizedPreview = '';
            this.resizedBlob = null;
            this.resizedSize = 0;
            this.aspectRatio = 1;
            this.processing = false;
            this.error = '';
        },

        downloadResized() {
            if (!this.resizedBlob) return;

            const extension = this.outputFormat === 'webp' ? 'webp' : 'jpg';
            const baseName = this.originalName.replace(/\.[^/.]+$/, '');
            const link = document.createElement('a');

            link.href = this.resizedPreview;
            link.download = `${baseName}-${this.width}x${this.height}.${extension}`;
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

        async shareTool() {
            const shareData = {
                title: 'Image Resizer - ToolNova',
                text: 'Resize images online with this free Image Resizer tool.',
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