import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('invoiceGenerator', () => ({
        businessName: '',
        businessEmail: '',
        businessPhone: '',
        businessAddress: '',

        clientName: '',
        clientEmail: '',
        clientPhone: '',
        clientAddress: '',

        invoiceNumber: `INV-${new Date().getFullYear()}-001`,
        invoiceDate: new Date().toISOString().split('T')[0],
        dueDate: '',
        currency: 'USD',

        discountType: 'percent',
        discountValue: '',
        taxType: 'percent',
        taxValue: '',
        notes: '',
        copied: false,

        items: [
            { description: '', quantity: 1, price: 0 }
        ],

        openHowTo: false,
        openFaq: null,

        faqItems: [
            {
                q: 'What does this invoice generator do?',
                a: 'It helps you create a professional invoice with seller details, customer details, items, totals, discount and tax.'
            },
            {
                q: 'Can I add multiple items?',
                a: 'Yes. You can add as many invoice line items as you need.'
            },
            {
                q: 'Does it calculate totals automatically?',
                a: 'Yes. Subtotal, discount, tax and grand total are calculated automatically.'
            },
            {
                q: 'Can I print the invoice?',
                a: 'Yes. This version includes a print-ready invoice layout.'
            },
            {
                q: 'Can I use it for services and products?',
                a: 'Yes. You can use it for freelance work, services, physical products or general billing.'
            },
            {
                q: 'Does this tool save my invoice data?',
                a: 'No. The invoice is prepared in the browser unless you choose to save it yourself.'
            },
            {
                q: 'Can I use different currencies?',
                a: 'Yes. You can select from a few common currencies in this version.'
            },
            {
                q: 'Who can use this tool?',
                a: 'It is useful for freelancers, agencies, shop owners, consultants, contractors and small businesses.'
            }
        ],

        init() {
            const today = new Date();
            const due = new Date();
            due.setDate(today.getDate() + 7);
            this.dueDate = due.toISOString().split('T')[0];
        },

        toggleFaq(index) {
            this.openFaq = this.openFaq === index ? null : index;
        },

        addItem() {
            this.items.push({
                description: '',
                quantity: 1,
                price: 0
            });
        },

        removeItem(index) {
            if (this.items.length === 1) return;
            this.items.splice(index, 1);
        },

        itemTotal(item) {
            const qty = Number(item.quantity) || 0;
            const price = Number(item.price) || 0;
            return qty * price;
        },

        get subtotal() {
            return this.items.reduce((sum, item) => sum + this.itemTotal(item), 0);
        },

        get discountAmount() {
            const discount = Number(this.discountValue) || 0;

            if (this.discountType === 'percent') {
                return (this.subtotal * discount) / 100;
            }

            return discount;
        },

        get taxableAmount() {
            return Math.max(this.subtotal - this.discountAmount, 0);
        },

        get taxAmount() {
            const tax = Number(this.taxValue) || 0;

            if (this.taxType === 'percent') {
                return (this.taxableAmount * tax) / 100;
            }

            return tax;
        },

        get grandTotal() {
            return Math.max(this.taxableAmount + this.taxAmount, 0);
        },

        currencySymbol() {
            const map = {
                USD: '$',
                EUR: '€',
                GBP: '£',
                TZS: 'TSh',
                KES: 'KSh'
            };
            return map[this.currency] || this.currency;
        },

        formatMoney(value) {
            const amount = Number(value) || 0;
            return `${this.currencySymbol()} ${amount.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
        },

        clearAll() {
            this.businessName = '';
            this.businessEmail = '';
            this.businessPhone = '';
            this.businessAddress = '';

            this.clientName = '';
            this.clientEmail = '';
            this.clientPhone = '';
            this.clientAddress = '';

            this.invoiceNumber = `INV-${new Date().getFullYear()}-001`;
            this.invoiceDate = new Date().toISOString().split('T')[0];

            const due = new Date();
            due.setDate(due.getDate() + 7);
            this.dueDate = due.toISOString().split('T')[0];

            this.currency = 'USD';
            this.discountType = 'percent';
            this.discountValue = '';
            this.taxType = 'percent';
            this.taxValue = '';
            this.notes = '';
            this.items = [{ description: '', quantity: 1, price: 0 }];
            this.copied = false;
        },

        printInvoice() {
            window.print();
        },

        buildInvoiceText() {
            const lines = [];

            lines.push(`Invoice Number: ${this.invoiceNumber}`);
            lines.push(`Invoice Date: ${this.invoiceDate}`);
            lines.push(`Due Date: ${this.dueDate}`);
            lines.push('');

            lines.push(`From: ${this.businessName}`);
            lines.push(`${this.businessEmail}`);
            lines.push(`${this.businessPhone}`);
            lines.push(`${this.businessAddress}`);
            lines.push('');

            lines.push(`Bill To: ${this.clientName}`);
            lines.push(`${this.clientEmail}`);
            lines.push(`${this.clientPhone}`);
            lines.push(`${this.clientAddress}`);
            lines.push('');

            lines.push('Items:');
            this.items.forEach((item, index) => {
                lines.push(
                    `${index + 1}. ${item.description} | Qty: ${item.quantity} | Price: ${this.formatMoney(item.price)} | Total: ${this.formatMoney(this.itemTotal(item))}`
                );
            });

            lines.push('');
            lines.push(`Subtotal: ${this.formatMoney(this.subtotal)}`);
            lines.push(`Discount: ${this.formatMoney(this.discountAmount)}`);
            lines.push(`Tax: ${this.formatMoney(this.taxAmount)}`);
            lines.push(`Grand Total: ${this.formatMoney(this.grandTotal)}`);

            if (this.notes) {
                lines.push('');
                lines.push(`Notes: ${this.notes}`);
            }

            return lines.join('\n');
        },

        async copyInvoice() {
            try {
                await navigator.clipboard.writeText(this.buildInvoiceText());
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
                title: 'Invoice Generator - ToolNova',
                text: 'Create professional invoices online with this free Invoice Generator.',
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