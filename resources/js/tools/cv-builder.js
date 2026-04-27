function cvBuilder(cvData = {}, isAuthenticated = false) {
    return {
        selectedTemplate: 'tz-local',
        downloading: false,
        copied: false,
        printing: false,
        saving: false,
        usageStarted: false,
        isAuthenticated: Boolean(isAuthenticated),

        premium: {
            requiresPayment: true,
            canDownload: true,
            canCopy: true,
            canPrint: true,
            planName: 'Premium CV Builder',
        },

        notice: {
            show: false,
            type: 'info',
            title: '',
            message: '',
        },

        saveTitle: '',
        saveTitleError: '',

        personal: {
            surname: '',
            firstName: '',
            otherNames: '',
            sex: '',
            maritalStatus: '',
            birthDate: '',
            nationality: 'Tanzanian',
        },

        contact: {
            address: '',
            mobile1: '',
            mobile2: '',
            email: '',
        },

        education: [
            {
                year: '',
                institution: '',
                awardCourse: '',
            },
        ],

        experience: [
            {
                period: '',
                title: '',
                organization: '',
                description: '',
            },
        ],

        skillsText: '',
        additionalSkillsText: '',

        languages: [
            {
                language: '',
                reading: '',
                writing: '',
                speaking: '',
            },
        ],

        interestsText: '',
        declaration: 'I hereby declare that the information given above is true and correct to the best of my knowledge.',

        referees: [
            {
                name: '',
                title: '',
                organization: '',
                address: '',
                mobile: '',
            },
        ],

        signatureDataUrl: '',
        signatureDate: '',
        useTodayDate: true,

        init() {
            if (Object.keys(cvData).length > 0) {
                this.loadCvData(cvData);
            } else {
                this.loadFromStorage();
            }

            this.$watch(
                () => this.exportState(),
                () => {
                    this.saveToStorage();
                    this.markUsageStarted();
                }
            );

            this.trackPageView();
        },

        loadCvData(data) {
            if (data.selectedTemplate) {
                this.selectedTemplate = data.selectedTemplate;
            }

            if (data.personal) {
                this.personal = {
                    ...this.personal,
                    ...data.personal,
                };
            }

            if (data.contact) {
                this.contact = {
                    ...this.contact,
                    ...data.contact,
                };
            }

            if (Array.isArray(data.education) && data.education.length) {
                this.education = data.education.map((item) => ({
                    year: item.year || '',
                    institution: item.institution || item.school || '',
                    awardCourse: item.awardCourse || item.award || item.course || '',
                }));
            }

            if (Array.isArray(data.experience) && data.experience.length) {
                this.experience = data.experience.map((item) => ({
                    period: item.period || '',
                    title: item.title || '',
                    organization: item.organization || '',
                    description: item.description || '',
                }));
            }

            if (Array.isArray(data.skills)) {
                this.skillsText = data.skills.join('\n');
            } else if (typeof data.skills === 'string') {
                this.skillsText = data.skills;
            }

            if (Array.isArray(data.additionalSkills)) {
                this.additionalSkillsText = data.additionalSkills.join('\n');
            } else if (typeof data.additionalSkills === 'string') {
                this.additionalSkillsText = data.additionalSkills;
            }

            if (Array.isArray(data.languages) && data.languages.length) {
                this.languages = data.languages.map((item) => ({
                    language: item.language || '',
                    reading: item.reading || '',
                    writing: item.writing || '',
                    speaking: item.speaking || '',
                }));
            }

            if (Array.isArray(data.interests)) {
                this.interestsText = data.interests.join('\n');
            } else if (typeof data.interests === 'string') {
                this.interestsText = data.interests;
            }

            if (typeof data.declaration === 'string') {
                this.declaration = data.declaration;
            }

            if (Array.isArray(data.referees) && data.referees.length) {
                this.referees = data.referees.map((item) => ({
                    name: item.name || '',
                    title: item.title || '',
                    organization: item.organization || '',
                    address: item.address || '',
                    mobile: item.mobile || '',
                }));
            }

            if (typeof data.signatureDataUrl === 'string') {
                this.signatureDataUrl = data.signatureDataUrl;
            }

            if (typeof data.signatureDate === 'string') {
                this.signatureDate = data.signatureDate;
            }

            if (typeof data.useTodayDate === 'boolean') {
                this.useTodayDate = data.useTodayDate;
            }
        },

        exportState() {
            return JSON.stringify({
                selectedTemplate: this.selectedTemplate,
                personal: this.personal,
                contact: this.contact,
                education: this.education,
                experience: this.experience,
                skillsText: this.skillsText,
                additionalSkillsText: this.additionalSkillsText,
                languages: this.languages,
                interestsText: this.interestsText,
                declaration: this.declaration,
                referees: this.referees,
                signatureDataUrl: this.signatureDataUrl,
                signatureDate: this.signatureDate,
                useTodayDate: this.useTodayDate,
            });
        },

        saveToStorage() {
            try {
                localStorage.setItem('toolnova_cv_builder', this.exportState());
            } catch (error) {
                console.warn('CV Builder storage save failed.', error);
            }
        },

        loadFromStorage() {
            try {
                const raw = localStorage.getItem('toolnova_cv_builder');
                if (!raw) return;

                const parsed = JSON.parse(raw);
                this.loadCvData(parsed);
            } catch (error) {
                console.warn('CV Builder storage load failed.', error);
            }
        },

        showNotice(type, title, message) {
            this.notice = {
                show: true,
                type,
                title,
                message,
            };
        },

        hideNotice() {
            this.notice.show = false;
        },

        trackPageView() {
            if (typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('cv-builder', 'page_view');
            }
        },

        markUsageStarted() {
            if (this.usageStarted) return;

            this.usageStarted = true;

            if (typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('cv-builder', 'start_building');
            }
        },

        trackEvent(action, meta = {}) {
            if (typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('cv-builder', action, meta);
            }
        },

        validateEmail(value) {
            if (!value) return '';

            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(String(value).trim()) ? '' : 'Weka email sahihi.';
        },

        validatePhone(value) {
            if (!value) return '';

            const normalized = String(value).trim();
            const regex = /^[0-9+\-\s()]{7,20}$/;

            if (!regex.test(normalized)) {
                return 'Weka namba sahihi ya simu.';
            }

            const digitCount = normalized.replace(/\D/g, '').length;
            if (digitCount < 7 || digitCount > 15) {
                return 'Weka namba sahihi ya simu.';
            }

            return '';
        },

        splitTextList(value) {
            if (!value || typeof value !== 'string') return [];

            return value
                .split(/\n|,/)
                .map((item) => item.trim())
                .filter(Boolean);
        },

        get fullName() {
            return [
                this.personal.surname,
                this.personal.firstName,
                this.personal.otherNames,
            ]
                .map((item) => (item || '').trim())
                .filter(Boolean)
                .join(' ');
        },

        get hasPersonalInfo() {
            return Boolean(
                this.personal.surname ||
                this.personal.firstName ||
                this.personal.otherNames ||
                this.personal.sex ||
                this.personal.maritalStatus ||
                this.personal.birthDate ||
                this.personal.nationality
            );
        },

        get hasContactInfo() {
            return Boolean(
                this.contact.address ||
                this.contact.mobile1 ||
                this.contact.mobile2 ||
                this.contact.email
            );
        },

        get skillsList() {
            return this.splitTextList(this.skillsText);
        },

        get additionalSkillsList() {
            return this.splitTextList(this.additionalSkillsText);
        },

        get interestsList() {
            return this.splitTextList(this.interestsText);
        },

        get errors() {
            return {
                surname: !String(this.personal.surname || '').trim() ? 'Weka surname.' : '',
                firstName: !String(this.personal.firstName || '').trim() ? 'Weka first name.' : '',
                address: !String(this.contact.address || '').trim() ? 'Weka address.' : '',
                mobile1: this.validatePhone(this.contact.mobile1) || (!String(this.contact.mobile1 || '').trim() ? 'Weka namba ya simu.' : ''),
                mobile2: this.validatePhone(this.contact.mobile2),
                email: this.validateEmail(this.contact.email) || (!String(this.contact.email || '').trim() ? 'Weka email.' : ''),
            };
        },

        get hasValidationErrors() {
            return Object.values(this.errors).some(Boolean);
        },

        hasEducationEntry(item) {
            return Boolean(
                (item.year && item.year.trim()) ||
                (item.institution && item.institution.trim()) ||
                (item.awardCourse && item.awardCourse.trim())
            );
        },

        hasExperienceEntry(item) {
            return Boolean(
                (item.period && item.period.trim()) ||
                (item.title && item.title.trim()) ||
                (item.organization && item.organization.trim()) ||
                (item.description && item.description.trim())
            );
        },

        hasLanguageEntry(item) {
            return Boolean(
                (item.language && item.language.trim()) ||
                (item.reading && item.reading.trim()) ||
                (item.writing && item.writing.trim()) ||
                (item.speaking && item.speaking.trim())
            );
        },

        hasRefereeEntry(item) {
            return Boolean(
                (item.name && item.name.trim()) ||
                (item.title && item.title.trim()) ||
                (item.organization && item.organization.trim()) ||
                (item.address && item.address.trim()) ||
                (item.mobile && item.mobile.trim())
            );
        },

        get validEducation() {
            return this.education.filter((item) => this.hasEducationEntry(item));
        },

        get validExperience() {
            return this.experience.filter((item) => this.hasExperienceEntry(item));
        },

        get validLanguages() {
            return this.languages.filter((item) => this.hasLanguageEntry(item));
        },

        get validReferees() {
            return this.referees.filter((item) => this.hasRefereeEntry(item));
        },

        addEducation() {
            this.education.push({
                year: '',
                institution: '',
                awardCourse: '',
            });
        },

        removeEducation(index) {
            this.education.splice(index, 1);

            if (!this.education.length) {
                this.addEducation();
            }
        },

        addExperience() {
            this.experience.push({
                period: '',
                title: '',
                organization: '',
                description: '',
            });
        },

        removeExperience(index) {
            this.experience.splice(index, 1);

            if (!this.experience.length) {
                this.addExperience();
            }
        },

        addLanguage() {
            this.languages.push({
                language: '',
                reading: '',
                writing: '',
                speaking: '',
            });
        },

        removeLanguage(index) {
            this.languages.splice(index, 1);

            if (!this.languages.length) {
                this.addLanguage();
            }
        },

        addReferee() {
            this.referees.push({
                name: '',
                title: '',
                organization: '',
                address: '',
                mobile: '',
            });
        },

        removeReferee(index) {
            this.referees.splice(index, 1);

            if (!this.referees.length) {
                this.addReferee();
            }
        },

        get completionScore() {
            let score = 0;

            if (this.personal.surname.trim()) score += 10;
            if (this.personal.firstName.trim()) score += 10;
            if (this.contact.address.trim()) score += 10;
            if (this.contact.mobile1.trim()) score += 10;
            if (this.contact.email.trim()) score += 10;
            if (this.validEducation.length >= 1) score += 15;
            if (this.validExperience.length >= 1) score += 15;
            if (this.skillsList.length >= 2) score += 8;
            if (this.validLanguages.length >= 1) score += 6;
            if (this.validReferees.length >= 1) score += 6;

            return Math.min(score, 100);
        },

        get qualityLabel() {
            if (this.completionScore >= 85) return 'Excellent';
            if (this.completionScore >= 70) return 'Strong';
            if (this.completionScore >= 55) return 'Good';
            return 'Needs More Details';
        },

        get qualityColor() {
            if (this.completionScore >= 85) return 'bg-emerald-500';
            if (this.completionScore >= 70) return 'bg-blue-600';
            if (this.completionScore >= 55) return 'bg-amber-500';
            return 'bg-rose-500';
        },

        get qualityWidth() {
            return `${this.completionScore}%`;
        },

        get displaySignatureDate() {
            if (this.useTodayDate) {
                return new Date().toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                });
            }

            return this.signatureDate || '';
        },

        get quickTips() {
            const tips = [];

            if (!this.personal.surname.trim()) {
                tips.push('Jaza surname.');
            }

            if (!this.personal.firstName.trim()) {
                tips.push('Jaza first name.');
            }

            if (!this.contact.address.trim()) {
                tips.push('Weka contact address.');
            }

            if (!this.contact.mobile1.trim()) {
                tips.push('Weka namba ya simu ya kwanza.');
            }

            if (!this.contact.email.trim()) {
                tips.push('Weka email address.');
            }

            if (this.validEducation.length < 1) {
                tips.push('Ongeza education background angalau moja.');
            }

            if (this.validExperience.length < 1) {
                tips.push('Ongeza working experience angalau moja.');
            }

            if (this.validReferees.length < 1) {
                tips.push('Weka angalau referee mmoja.');
            }

            return tips.slice(0, 6);
        },

        handleSignatureUpload(event) {
            const file = event.target.files?.[0];
            if (!file) return;

            const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                this.showNotice('error', 'Invalid file type', 'Upload signature as PNG, JPG, or WEBP image.');
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                this.showNotice('error', 'File too large', 'Signature image must be smaller than 2MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = () => {
                this.signatureDataUrl = reader.result;
                this.trackEvent('signature_upload', { file_type: file.type });
                this.showNotice('success', 'Signature uploaded', 'Signature imeongezwa kwenye CV preview.');
            };
            reader.readAsDataURL(file);
        },

        toggleAutoDate() {
            if (this.useTodayDate) {
                this.signatureDate = '';
            }
        },

        clearSignature() {
            this.signatureDataUrl = '';
            this.showNotice('info', 'Signature cleared', 'Signature imeondolewa kutoka kwenye CV.');
        },

        buildPayload() {
            return {
                selectedTemplate: this.selectedTemplate,
                personal: { ...this.personal },
                contact: { ...this.contact },
                education: this.validEducation,
                experience: this.validExperience,
                skills: this.skillsList,
                additionalSkills: this.additionalSkillsList,
                languages: this.validLanguages,
                interests: this.interestsList,
                declaration: this.declaration.trim(),
                referees: this.validReferees,
                signatureDataUrl: this.signatureDataUrl,
                signatureDate: this.signatureDate,
                useTodayDate: this.useTodayDate,
            };
        },

        makeDownloadFilename(format = 'pdf') {
            const name = (this.fullName || 'cv')
                .trim()
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '') || 'cv';

            return `${name}.${format === 'word' ? 'doc' : 'pdf'}`;
        },

        async downloadFile(format = 'pdf') {
            if (this.downloading) return;

            if (this.hasValidationErrors) {
                this.showNotice(
                    'error',
                    'Kuna makosa kwenye taarifa zako',
                    'Tafadhali sahihisha sehemu zenye makosa kabla ya kupakua file.'
                );
                return;
            }

            if (!this.premium.canDownload) {
                this.showNotice(
                    'warning',
                    'Download imefungwa',
                    'Pakua CV kunahitaji mpango wa kulipia. Tafadhali upgrade ili kuendelea.'
                );

                this.trackEvent('download_blocked', {
                    reason: 'payment_required',
                    format,
                });
                return;
            }

            this.hideNotice();
            this.downloading = true;

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const payload = this.buildPayload();

                const response = await fetch('/tools/cv-builder/download', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': '*/*',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': token,
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        ...payload,
                        format,
                    }),
                });

                const contentType = response.headers.get('content-type') || '';

                if (!response.ok) {
                    let message = 'Imeshindikana kutengeneza file kwa sasa. Tafadhali jaribu tena.';

                    if (contentType.includes('application/json')) {
                        const errorData = await response.json();
                        if (errorData?.message) message = errorData.message;
                        if (errorData?.error) message = errorData.error;
                    } else {
                        const text = await response.text();
                        if (text && text.length < 300) message = text;
                    }

                    throw new Error(message);
                }

                const blob = await response.blob();
                const objectUrl = window.URL.createObjectURL(blob);
                const link = document.createElement('a');

                link.href = objectUrl;
                link.download = this.makeDownloadFilename(format);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                setTimeout(() => {
                    window.URL.revokeObjectURL(objectUrl);
                }, 2000);

                this.showNotice(
                    'success',
                    'Download imekamilika',
                    format === 'pdf'
                        ? 'CV yako imepakuliwa kama PDF.'
                        : 'CV yako imepakuliwa kama Word document.'
                );

                this.trackEvent('file_download', {
                    format,
                    template: this.selectedTemplate,
                    completion_score: this.completionScore,
                });
            } catch (error) {
                console.error('CV download failed:', error);
                this.showNotice(
                    'error',
                    'Download imeshindikana',
                    error.message || 'Imeshindikana kupakua file kwa sasa.'
                );
            } finally {
                this.downloading = false;
            }
        },

        async downloadPdf() {
            return this.downloadFile('pdf');
        },

        async downloadWord() {
            return this.downloadFile('word');
        },

        async saveCv() {
            if (!this.isAuthenticated) {
                this.showNotice('warning', 'Login required', 'Ingia kwanza ili uweze kuhifadhi CV yako kwenye account.');
                return;
            }

            if (this.saving) return;

            this.saveTitleError = '';

            if (!this.saveTitle.trim()) {
                this.saveTitleError = 'Weka title ya CV.';
                this.showNotice('warning', 'Title required', 'Tafadhali jaza title kabla ya kuhifadhi.');
                return;
            }

            if (this.hasValidationErrors) {
                this.showNotice('error', 'Tafadhali rekebisha taarifa', 'Sahihisha sehemu zilizowekea makosa kabla ya kuhifadhi CV.');
                return;
            }

            this.hideNotice();
            this.saving = true;

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const payload = this.buildPayload();

                const response = await fetch('/tools/cv-builder/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': token,
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        title: this.saveTitle.trim(),
                        cv_data: payload,
                    }),
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Failed to save CV.');
                }

                this.showNotice('success', 'CV Saved', result.message || 'Your CV has been saved successfully.');

                this.trackEvent('cv_saved', {
                    template: this.selectedTemplate,
                    completion_score: this.completionScore,
                });
            } catch (error) {
                console.error('CV save failed:', error);
                this.showNotice('error', 'Save Failed', error.message || 'Failed to save CV. Please try again.');
            } finally {
                this.saving = false;
            }
        },

        async copyCv() {
            if (!this.premium.canCopy) {
                this.showNotice('warning', 'Copy imefungwa', 'Kopi ya CV inahitaji mpango wa kulipia.');
                this.trackEvent('copy_blocked', { reason: 'payment_required' });
                return;
            }

            try {
                const text = this.buildCvText();
                await navigator.clipboard.writeText(text);

                this.copied = true;

                this.showNotice('success', 'CV imekopiwa', 'Maandishi ya CV yamekopiwa kwenye clipboard.');

                this.trackEvent('copy', {
                    template: this.selectedTemplate,
                });

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                console.error('CV copy failed:', error);
                this.showNotice('error', 'Copy imeshindikana', 'Imeshindikana kukopi CV kwa sasa.');
            }
        },

        printCv() {
            if (!this.premium.canPrint) {
                this.showNotice('warning', 'Print imefungwa', 'Kuchapisha CV kunahitaji mpango wa kulipia.');
                this.trackEvent('print_blocked', { reason: 'payment_required' });
                return;
            }

            this.printing = true;

            this.trackEvent('print', {
                template: this.selectedTemplate,
            });

            window.print();

            setTimeout(() => {
                this.printing = false;
            }, 800);
        },

        buildCvText() {
            const lines = [];

            lines.push('CURRICULUM VITAE');
            lines.push('');

            if (this.hasPersonalInfo) {
                lines.push('PERSONAL DETAILS');
                lines.push(`Surname: ${this.personal.surname || ''}`);
                lines.push(`First Name: ${this.personal.firstName || ''}`);

                if (this.personal.otherNames) lines.push(`Other Names: ${this.personal.otherNames}`);
                if (this.personal.sex) lines.push(`Sex: ${this.personal.sex}`);
                if (this.personal.maritalStatus) lines.push(`Marital Status: ${this.personal.maritalStatus}`);
                if (this.personal.birthDate) lines.push(`Birth Date: ${this.personal.birthDate}`);
                if (this.personal.nationality) lines.push(`Nationality: ${this.personal.nationality}`);
                lines.push('');
            }

            if (this.hasContactInfo) {
                lines.push('CONTACT DETAILS');
                if (this.contact.address) lines.push(`Address: ${this.contact.address}`);
                if (this.contact.mobile1 || this.contact.mobile2) {
                    lines.push(`Mobile: ${[this.contact.mobile1, this.contact.mobile2].filter(Boolean).join(', ')}`);
                }
                if (this.contact.email) lines.push(`E-mail: ${this.contact.email}`);
                lines.push('');
            }

            if (this.validEducation.length) {
                lines.push('EDUCATION BACKGROUND');
                this.validEducation.forEach((item) => {
                    lines.push([item.year, item.institution, item.awardCourse].filter(Boolean).join(' | '));
                });
                lines.push('');
            }

            if (this.validExperience.length) {
                lines.push('WORKING EXPERIENCE');
                this.validExperience.forEach((item) => {
                    lines.push([item.period, item.title, item.organization].filter(Boolean).join(' | '));
                    if (item.description) lines.push(item.description);
                    lines.push('');
                });
            }

            if (this.skillsList.length) {
                lines.push('ABILITY / SKILLS');
                this.skillsList.forEach((item) => lines.push(`• ${item}`));
                lines.push('');
            }

            if (this.additionalSkillsList.length) {
                lines.push('EXTRA KNOWLEDGE');
                this.additionalSkillsList.forEach((item) => lines.push(`• ${item}`));
                lines.push('');
            }

            if (this.validLanguages.length) {
                lines.push('LANGUAGE SKILLS');
                this.validLanguages.forEach((item) => {
                    lines.push(
                        [
                            item.language,
                            `Reading: ${item.reading || '-'}`,
                            `Writing: ${item.writing || '-'}`,
                            `Speaking: ${item.speaking || '-'}`,
                        ].join(' | ')
                    );
                });
                lines.push('');
            }

            if (this.interestsList.length) {
                lines.push('INTEREST / HOBBIES');
                this.interestsList.forEach((item) => lines.push(`• ${item}`));
                lines.push('');
            }

            if (this.validReferees.length) {
                lines.push('REFEREES');
                this.validReferees.forEach((item) => {
                    lines.push([item.name, item.title, item.organization, item.address, item.mobile].filter(Boolean).join(' | '));
                    lines.push('');
                });
            }

            if (this.declaration.trim()) {
                lines.push('DECLARATION');
                lines.push(this.declaration.trim());
                lines.push('');
            }

            lines.push('Signature: ____________________');
            if (this.displaySignatureDate) {
                lines.push(`Date: ${this.displaySignatureDate}`);
            }

            return lines.join('\n').trim();
        },

        clearAll() {
            this.selectedTemplate = 'tz-local';
            this.downloading = false;
            this.copied = false;
            this.printing = false;
            this.saving = false;
            this.usageStarted = false;
            this.saveTitle = '';
            this.saveTitleError = '';

            this.notice = {
                show: false,
                type: 'info',
                title: '',
                message: '',
            };

            this.personal = {
                surname: '',
                firstName: '',
                otherNames: '',
                sex: '',
                maritalStatus: '',
                birthDate: '',
                nationality: 'Tanzanian',
            };

            this.contact = {
                address: '',
                mobile1: '',
                mobile2: '',
                email: '',
            };

            this.education = [
                {
                    year: '',
                    institution: '',
                    awardCourse: '',
                },
            ];

            this.experience = [
                {
                    period: '',
                    title: '',
                    organization: '',
                    description: '',
                },
            ];

            this.skillsText = '';
            this.additionalSkillsText = '';

            this.languages = [
                {
                    language: '',
                    reading: '',
                    writing: '',
                    speaking: '',
                },
            ];

            this.interestsText = '';
            this.declaration = 'I hereby declare that the information given above is true and correct to the best of my knowledge.';

            this.referees = [
                {
                    name: '',
                    title: '',
                    organization: '',
                    address: '',
                    mobile: '',
                },
            ];

            this.signatureDataUrl = '';
            this.signatureDate = '';
            this.useTodayDate = true;

            try {
                localStorage.removeItem('toolnova_cv_builder');
            } catch (error) {
                console.warn('CV Builder storage clear failed.', error);
            }

            this.showNotice('info', 'Form imesafishwa', 'Taarifa zote za CV zimeondolewa. Unaweza kuanza upya.');
            this.trackEvent('clear');
        },
    };
}

window.cvBuilder = cvBuilder;