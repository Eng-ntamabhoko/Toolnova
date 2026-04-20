import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('randomNameGenerator', () => ({
        category: 'unisex',
        count: 10,
        names: [],
        copied: false,
        openHowTo: false,
        openFaq: null,

        datasets: {
            male: [
                'Liam', 'Noah', 'Ethan', 'Mason', 'Elijah', 'Lucas', 'Aiden', 'Caleb', 'Nathan', 'Leo',
                'Daniel', 'Julian', 'Ryan', 'Isaac', 'Adrian', 'Owen', 'David', 'Ezra', 'Samuel', 'Micah'
            ],
            female: [
                'Olivia', 'Emma', 'Sophia', 'Ava', 'Mia', 'Isabella', 'Amelia', 'Ella', 'Luna', 'Grace',
                'Chloe', 'Nora', 'Aria', 'Layla', 'Zoe', 'Hannah', 'Stella', 'Naomi', 'Aaliyah', 'Claire'
            ],
            unisex: [
                'Alex', 'Jordan', 'Taylor', 'Avery', 'Riley', 'Morgan', 'Skyler', 'Casey', 'Rowan', 'Parker',
                'Quinn', 'Reese', 'Sage', 'Harper', 'Cameron', 'Dakota', 'Phoenix', 'Emery', 'Jamie', 'Blake'
            ],
            fantasy: [
                'Zorath', 'Elira', 'Vael', 'Nythera', 'Draven', 'Kaelith', 'Sylor', 'Thalor', 'Aeryn', 'Virel',
                'Lorien', 'Zephra', 'Myrren', 'Ravyn', 'Caldor', 'Elyndra', 'Toren', 'Seraphis', 'Velora', 'Xandor'
            ],
            brand: [
                'Novara', 'Zentra', 'Velix', 'Lumora', 'Nexora', 'Quantix', 'Solvix', 'Bravion', 'Aurevia', 'Trendora',
                'Craftivo', 'Monvex', 'Tekvora', 'Opterra', 'Inovexa', 'Vistara', 'Brandiq', 'Corevia', 'Hexora', 'Orbixa'
            ]
        },

        faqItems: [
            {
                q: 'What does this random name generator do?',
                a: 'It creates random names from selected categories such as male, female, unisex, fantasy and brand-style names.'
            },
            {
                q: 'Can I generate multiple names at once?',
                a: 'Yes. You can choose how many names you want to generate at the same time.'
            },
            {
                q: 'Can I use these names for characters or stories?',
                a: 'Yes. The tool is useful for stories, games, writing, usernames, businesses and creative projects.'
            },
            {
                q: 'What are brand names in this tool?',
                a: 'Brand names are short, modern and startup-style names that can inspire project names or business ideas.'
            },
            {
                q: 'Are the names unique every time?',
                a: 'They are randomly selected from the available list, so repeated names may appear sometimes.'
            },
            {
                q: 'Can I copy the generated names?',
                a: 'Yes. You can copy all generated names with one click.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for writers, gamers, entrepreneurs, parents, students and content creators.'
            },
            {
                q: 'Can I generate fantasy names?',
                a: 'Yes. The fantasy category is included for stories, role-playing and fictional worlds.'
            }
        ],

        init() {
            this.generateNames();

            this.$watch('category', () => this.generateNames());
            this.$watch('count', () => this.generateNames());
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        generateNames() {
            const pool = this.datasets[this.category] || this.datasets.unisex;
            const count = Math.min(Math.max(Number(this.count) || 1, 1), 30);

            const generated = [];
            for (let i = 0; i < count; i++) {
                const randomIndex = Math.floor(Math.random() * pool.length);
                generated.push(pool[randomIndex]);
            }

            this.names = generated;
            this.copied = false;
        },

        clearAll() {
            this.category = 'unisex';
            this.count = 10;
            this.names = [];
            this.copied = false;
        },

        async copyNames() {
            if (!this.names.length) return;

            try {
                await navigator.clipboard.writeText(this.names.join('\n'));
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
                title: 'Random Name Generator - ToolNova',
                text: 'Generate random names online with this free Random Name Generator.',
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