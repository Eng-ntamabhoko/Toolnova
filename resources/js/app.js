import './bootstrap';
import Alpine from 'alpinejs';
import './tools/age-calculator';
import './tools/word-counter';
import './tools/password-generator';
import './tools/json-formatter';
import './tools/qr-code-generator';
import './tools/text-case-converter';
import './tools/image-compressor';
import './tools/image-resizer';
import './tools/percentage-calculator';
import './tools/discount-calculator';
import './tools/loan-calculator';
import './tools/base64-encoder-decoder';
import './tools/random-name-generator';
import './tools/invoice-generator';
import './tools/resume-builder';
import './tools/cv-builder';


window.Alpine = Alpine;

Alpine.start();
window.trackToolUsage = async function (toolSlug, actionType = 'tool_use', meta = {}) {
    try {
        const pageUrl = window.location.href;
        const pagePath = `${window.location.pathname}${window.location.search}`;

        await fetch('/track/tool-use', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                tool_slug: toolSlug,
                action_type: actionType,
                meta: {
                    page_url: pageUrl,
                    page_path: pagePath,
                    ...meta,
                },
            }),
        });
    } catch (error) {
        console.error('Tracking failed:', error);
    }
};

window.__toolTrackingTimers = {};
window.__toolTrackingLocks = {};

window.trackToolUsageDebounced = function (
    toolSlug,
    actionType = 'tool_use',
    meta = {},
    delay = 1200
) {
    const key = `${toolSlug}:${actionType}`;

    if (window.__toolTrackingTimers[key]) {
        clearTimeout(window.__toolTrackingTimers[key]);
    }

    window.__toolTrackingTimers[key] = setTimeout(async () => {
        const now = Date.now();
        const lastTrackedAt = window.__toolTrackingLocks[key] || 0;

        // Zuia tracking nyingi mno ndani ya muda mfupi
        if (now - lastTrackedAt < 5000) {
            return;
        }

        window.__toolTrackingLocks[key] = now;

        if (window.trackToolUsage) {
            await window.trackToolUsage(toolSlug, actionType, meta);
        }
    }, delay);
};

// Global tool usage tracking (debounced) for any tool without needing to modify individual tool scripts
// Listens for interactive events and sends a single tracked call per debounce window.
if (typeof document !== 'undefined') {
    document.addEventListener('input', (event) => {
        const toolRoot = event.target.closest('[data-tool-slug]');
        if (!toolRoot) return;

        const toolSlug = toolRoot.getAttribute('data-tool-slug');
        if (!toolSlug) return;

        if (window.trackToolUsageDebounced) {
            window.trackToolUsageDebounced(toolSlug, 'tool_use', {
                source: 'global_input',
            }, 1200);
        }
    });

    document.addEventListener('change', (event) => {
        const toolRoot = event.target.closest('[data-tool-slug]');
        if (!toolRoot) return;

        const toolSlug = toolRoot.getAttribute('data-tool-slug');
        if (!toolSlug) return;

        if (window.trackToolUsageDebounced) {
            window.trackToolUsageDebounced(toolSlug, 'tool_use', {
                source: 'global_change',
            }, 800);
        }
    });
}
