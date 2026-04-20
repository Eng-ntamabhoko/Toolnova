import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('wordCounter', () => ({
        text: '',
        copied: false,
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this word counter tool do?',
                a: 'It counts words, characters, characters without spaces, sentences, paragraphs, reading time and speaking time instantly.'
            },
            {
                q: 'Does the count update automatically?',
                a: 'Yes. The results update live as you type, paste or edit your text.'
            },
            {
                q: 'How is reading time calculated?',
                a: 'Reading time is estimated using an average reading speed of about 200 words per minute.'
            },
            {
                q: 'How is speaking time calculated?',
                a: 'Speaking time is estimated using an average speaking speed of about 130 words per minute.'
            },
            {
                q: 'Can I paste large text into the tool?',
                a: 'Yes. You can paste articles, essays, reports, captions or other text content and the tool will calculate the results.'
            },
            {
                q: 'Does this tool save my text?',
                a: 'No. The tool works in the browser and simply analyzes the text you enter on the page.'
            },
            {
                q: 'Why do word counts sometimes differ between tools?',
                a: 'Different tools may treat punctuation, line breaks, symbols or repeated spaces differently, so the final count can vary slightly.'
            },
            {
                q: 'Is this tool useful for essays and social media posts?',
                a: 'Yes. It is useful for essays, blog posts, captions, product descriptions, assignments and many other writing tasks.'
            }
        ],

        get trimmedText() {
            return this.text.trim();
        },

        get words() {
            if (!this.trimmedText) return 0;
            return this.trimmedText.split(/\s+/).filter(Boolean).length;
        },

        get characters() {
            return this.text.length;
        },

        get charactersNoSpaces() {
            if (!this.text) return 0;
            return this.text.replace(/\s/g, '').length;
        },

        get sentences() {
            if (!this.trimmedText) return 0;
            return this.trimmedText
                .split(/[.!?]+/)
                .map(item => item.trim())
                .filter(Boolean).length;
        },

        get paragraphs() {
            if (!this.trimmedText) return 0;
            return this.trimmedText
                .split(/\n\s*\n/)
                .map(item => item.trim())
                .filter(Boolean).length;
        },

        get readingTimeMinutes() {
            if (this.words === 0) return 0;
            return Math.max(1, Math.ceil(this.words / 200));
        },

        get speakingTimeMinutes() {
            if (this.words === 0) return 0;
            return Math.max(1, Math.ceil(this.words / 130));
        },

        get topKeywords() {
            if (!this.trimmedText) return [];

            const stopWords = new Set([
                'the', 'and', 'for', 'that', 'with', 'this', 'from', 'have', 'your',
                'you', 'are', 'was', 'were', 'will', 'has', 'had', 'not', 'but',
                'they', 'their', 'them', 'his', 'her', 'she', 'him', 'our', 'out',
                'about', 'into', 'than', 'then', 'what', 'when', 'where', 'which',
                'while', 'can', 'could', 'should', 'would', 'there', 'here', 'some',
                'more', 'most', 'also', 'just', 'very', 'text', 'words'
            ]);

            const cleanedWords = this.trimmedText
                .toLowerCase()
                .replace(/[^a-z0-9\s]/g, ' ')
                .split(/\s+/)
                .filter(word => word.length > 2 && !stopWords.has(word));

            const counts = {};

            cleanedWords.forEach(word => {
                counts[word] = (counts[word] || 0) + 1;
            });

            return Object.entries(counts)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 5)
                .map(([word, count]) => ({ word, count }));
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        clearText() {
            this.text = '';
            this.copied = false;
        },

        async copyText() {
            try {
                await navigator.clipboard.writeText(this.text);
                this.copied = true;

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                // ignore
            }
        },

        async shareText() {
            const shareData = {
                title: 'Word Counter - ToolNova',
                text: this.text || 'Check out this Word Counter tool on ToolNova.',
                url: window.location.href,
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    await this.copyText();
                }
            } catch (error) {
                // ignore
            }
        }
    }));
});