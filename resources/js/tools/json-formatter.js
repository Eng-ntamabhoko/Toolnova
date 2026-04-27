import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('jsonFormatter', () => ({
        inputJson: '',
        outputJson: '',
        copied: false,
        error: '',
        errorLine: null,
        errorColumn: null,
        validJson: null,
        indentSize: 4,
        sortKeysEnabled: false,
        parsedJson: null,
        stats: {
            keys: 0,
            objects: 0,
            arrays: 0,
            maxDepth: 0,
            characters: 0,
            outputSize: 0,
        },
        structureSummary: [],
        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this JSON formatter do?',
                a: 'It formats, validates, minifies and analyzes JSON data to make it easier to read and debug.'
            },
            {
                q: 'Can this tool detect invalid JSON?',
                a: 'Yes. If the JSON is invalid, the tool shows an error message with extra details to help you fix it.'
            },
            {
                q: 'What is the difference between format and minify?',
                a: 'Format adds spacing and indentation for readability, while minify removes unnecessary spaces and line breaks to make JSON compact.'
            },
            {
                q: 'What does sort keys do?',
                a: 'It arranges object keys alphabetically, which can make large JSON structures easier to scan and compare.'
            },
            {
                q: 'Can I upload a JSON file?',
                a: 'Yes. You can upload a .json file and the tool will load it into the editor.'
            },
            {
                q: 'Can I download the formatted JSON?',
                a: 'Yes. After formatting or minifying, you can download the output as a JSON file.'
            },
            {
                q: 'Does this tool save my JSON data?',
                a: 'No. The JSON is processed in the browser and not stored by the tool.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for developers, students, testers, analysts and anyone working with JSON data.'
            }
        ],

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        formatJson() {
            this.processJson('format');
        },

        minifyJson() {
            this.processJson('minify');
        },

        validateJson() {
            this.processJson('validate');
        },

        processJson(mode = 'format') {
            this.resetMessages();

            if (!this.inputJson.trim()) {
                this.outputJson = '';
                this.validJson = null;
                this.error = 'Please enter JSON data first.';
                return;
            }

            try {
                let parsed = JSON.parse(this.inputJson);

                if (this.sortKeysEnabled) {
                    parsed = this.sortKeysDeep(parsed);
                }

                this.parsedJson = parsed;
                this.validJson = true;

                if (mode === 'format') {
                    this.outputJson = JSON.stringify(parsed, null, Number(this.indentSize));
                } else if (mode === 'minify') {
                    this.outputJson = JSON.stringify(parsed);
                } else {
                    this.outputJson = '';
                }

                this.calculateStats(parsed);
                this.buildStructureSummary(parsed);
            } catch (e) {
                this.outputJson = '';
                this.parsedJson = null;
                this.validJson = false;
                this.extractErrorDetails(e);
            }
        },

        resetMessages() {
            this.error = '';
            this.errorLine = null;
            this.errorColumn = null;
            this.copied = false;
        },

        extractErrorDetails(error) {
            const message = error?.message || 'Invalid JSON. Please check the syntax and try again.';
            this.error = message;

            const positionMatch = message.match(/position\s+(\d+)/i);
            if (positionMatch) {
                const position = Number(positionMatch[1]);
                const details = this.getLineColumnFromPosition(this.inputJson, position);
                this.errorLine = details.line;
                this.errorColumn = details.column;
            }
        },

        getLineColumnFromPosition(text, position) {
            const sliced = text.slice(0, position);
            const lines = sliced.split('\n');
            const line = lines.length;
            const column = lines[lines.length - 1].length + 1;

            return { line, column };
        },

        sortKeysDeep(value) {
            if (Array.isArray(value)) {
                return value.map(item => this.sortKeysDeep(item));
            }

            if (value !== null && typeof value === 'object') {
                return Object.keys(value)
                    .sort((a, b) => a.localeCompare(b))
                    .reduce((acc, key) => {
                        acc[key] = this.sortKeysDeep(value[key]);
                        return acc;
                    }, {});
            }

            return value;
        },

        calculateStats(json) {
            let keys = 0;
            let objects = 0;
            let arrays = 0;
            let maxDepth = 0;

            const walk = (node, depth = 1) => {
                maxDepth = Math.max(maxDepth, depth);

                if (Array.isArray(node)) {
                    arrays++;
                    node.forEach(item => walk(item, depth + 1));
                    return;
                }

                if (node !== null && typeof node === 'object') {
                    objects++;
                    const nodeKeys = Object.keys(node);
                    keys += nodeKeys.length;
                    nodeKeys.forEach(key => walk(node[key], depth + 1));
                }
            };

            walk(json);

            this.stats = {
                keys,
                objects,
                arrays,
                maxDepth,
                characters: this.inputJson.length,
                outputSize: this.outputJson ? this.outputJson.length : JSON.stringify(json).length,
            };
        },

        buildStructureSummary(json) {
            this.structureSummary = [];

            if (json && typeof json === 'object' && !Array.isArray(json)) {
                this.structureSummary = Object.keys(json).slice(0, 12).map((key) => ({
                    key,
                    type: this.getTypeLabel(json[key]),
                }));
            } else if (Array.isArray(json)) {
                this.structureSummary = [
                    {
                        key: 'root',
                        type: `array (${json.length} items)`,
                    }
                ];
            } else {
                this.structureSummary = [
                    {
                        key: 'root',
                        type: this.getTypeLabel(json),
                    }
                ];
            }
        },

        getTypeLabel(value) {
            if (Array.isArray(value)) return `array (${value.length} items)`;
            if (value === null) return 'null';
            return typeof value;
        },

        clearAll() {
            this.inputJson = '';
            this.outputJson = '';
            this.parsedJson = null;
            this.error = '';
            this.errorLine = null;
            this.errorColumn = null;
            this.validJson = null;
            this.copied = false;
            this.structureSummary = [];
            this.stats = {
                keys: 0,
                objects: 0,
                arrays: 0,
                maxDepth: 0,
                characters: 0,
                outputSize: 0,
            };
        },

        handleFileUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.inputJson = e.target.result || '';
            };
            reader.readAsText(file);
        },

        downloadOutput() {
            if (!this.outputJson) return;

            const blob = new Blob([this.outputJson], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');

            link.href = url;
            link.download = 'formatted.json';
            link.click();

            URL.revokeObjectURL(url);
        },

        async copyOutput() {
            if (!this.outputJson) return;

            try {
                await navigator.clipboard.writeText(this.outputJson);
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
                title: 'JSON Formatter - ToolNova',
                text: 'Format, validate and minify JSON quickly with this free tool.',
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