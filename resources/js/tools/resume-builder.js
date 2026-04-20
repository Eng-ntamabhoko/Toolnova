function resumeBuilder() {
    return {
        selectedTemplate: 'professional',
        downloading: false,
        copied: false,

        personal: {
            fullName: '',
            jobTitle: '',
            email: '',
            phone: '',
            city: '',
            country: '',
            website: '',
            linkedin: '',
        },

        summary: '',
        skills: '',
        languages: '',
        certifications: '',
        jobDescription: '',

        experience: [
            {
                role: '',
                company: '',
                location: '',
                startDate: '',
                endDate: '',
                current: false,
                bullets: '',
            },
        ],

        education: [
            {
                school: '',
                degree: '',
                field: '',
                startDate: '',
                endDate: '',
            },
        ],

        projects: [
            {
                name: '',
                link: '',
                description: '',
            },
        ],

        weakPhrases: [
            'responsible for',
            'duties included',
            'worked on',
            'helped with',
            'assisted with',
            'in charge of',
            'tasked with',
            'handled',
        ],

        strongVerbs: [
            'led',
            'managed',
            'developed',
            'improved',
            'increased',
            'reduced',
            'implemented',
            'created',
            'delivered',
            'launched',
            'optimized',
            'designed',
            'built',
            'coordinated',
            'achieved',
            'generated',
            'streamlined',
            'executed',
        ],

        ignoredKeywords: [
            'and', 'the', 'with', 'for', 'from', 'that', 'this', 'have', 'will', 'your',
            'you', 'our', 'their', 'about', 'into', 'onto', 'role', 'team', 'work',
            'year', 'years', 'using', 'ability', 'skills', 'skill', 'strong', 'must',
            'should', 'required', 'preferred', 'candidate', 'job', 'position', 'experience'
        ],

        init() {
            this.loadFromStorage();

            this.$watch(
                () => this.exportState(),
                () => {
                    this.saveToStorage();
                }
            );
        },

        exportState() {
            return JSON.stringify({
                selectedTemplate: this.selectedTemplate,
                personal: this.personal,
                summary: this.summary,
                skills: this.skills,
                languages: this.languages,
                certifications: this.certifications,
                jobDescription: this.jobDescription,
                experience: this.experience,
                education: this.education,
                projects: this.projects,
            });
        },

        saveToStorage() {
            try {
                localStorage.setItem(
                    'toolnova_resume_builder',
                    JSON.stringify({
                        selectedTemplate: this.selectedTemplate,
                        personal: this.personal,
                        summary: this.summary,
                        skills: this.skills,
                        languages: this.languages,
                        certifications: this.certifications,
                        jobDescription: this.jobDescription,
                        experience: this.experience,
                        education: this.education,
                        projects: this.projects,
                    })
                );
            } catch (error) {
                console.warn('Resume Builder storage save failed.', error);
            }
        },

        loadFromStorage() {
            try {
                const raw = localStorage.getItem('toolnova_resume_builder');
                if (!raw) return;

                const parsed = JSON.parse(raw);

                this.selectedTemplate = parsed.selectedTemplate || 'professional';
                this.personal = { ...this.personal, ...(parsed.personal || {}) };
                this.summary = parsed.summary || '';
                this.skills = parsed.skills || '';
                this.languages = parsed.languages || '';
                this.certifications = parsed.certifications || '';
                this.jobDescription = parsed.jobDescription || '';

                this.experience = Array.isArray(parsed.experience) && parsed.experience.length
                    ? parsed.experience.map((job) => ({
                        role: job.role || '',
                        company: job.company || '',
                        location: job.location || '',
                        startDate: job.startDate || '',
                        endDate: job.endDate || '',
                        current: Boolean(job.current),
                        bullets: job.bullets || '',
                    }))
                    : this.experience;

                this.education = Array.isArray(parsed.education) && parsed.education.length
                    ? parsed.education.map((item) => ({
                        school: item.school || '',
                        degree: item.degree || '',
                        field: item.field || '',
                        startDate: item.startDate || '',
                        endDate: item.endDate || '',
                    }))
                    : this.education;

                this.projects = Array.isArray(parsed.projects) && parsed.projects.length
                    ? parsed.projects.map((project) => ({
                        name: project.name || '',
                        link: project.link || '',
                        description: project.description || '',
                    }))
                    : this.projects;
            } catch (error) {
                console.warn('Resume Builder storage load failed.', error);
            }
        },

        validateEmail(value) {
            if (!value) return '';
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value.trim()) ? '' : 'Enter a valid email address';
        },

        validatePhone(value) {
            if (!value) return '';
            const normalized = String(value).trim();
            const regex = /^[0-9+\-\s()]{7,20}$/;

            if (!regex.test(normalized)) {
                return 'Enter a valid phone number';
            }

            const digitCount = normalized.replace(/\D/g, '').length;
            if (digitCount < 7 || digitCount > 15) {
                return 'Enter a valid phone number';
            }

            return '';
        },

        validateUrl(value) {
            if (!value) return '';
            try {
                const url = new URL(value.trim());
                return ['http:', 'https:'].includes(url.protocol)
                    ? ''
                    : 'Enter a valid URL (include https://)';
            } catch {
                return 'Enter a valid URL (include https://)';
            }
        },

        get errors() {
            return {
                email: this.validateEmail(this.personal.email),
                phone: this.validatePhone(this.personal.phone),
                website: this.validateUrl(this.personal.website),
                linkedin: this.validateUrl(this.personal.linkedin),
            };
        },

        get hasValidationErrors() {
            return Object.values(this.errors).some(Boolean);
        },

        addExperience() {
            this.experience.push({
                role: '',
                company: '',
                location: '',
                startDate: '',
                endDate: '',
                current: false,
                bullets: '',
            });
        },

        removeExperience(index) {
            this.experience.splice(index, 1);
            if (!this.experience.length) this.addExperience();
        },

        addEducation() {
            this.education.push({
                school: '',
                degree: '',
                field: '',
                startDate: '',
                endDate: '',
            });
        },

        removeEducation(index) {
            this.education.splice(index, 1);
            if (!this.education.length) this.addEducation();
        },

        addProject() {
            this.projects.push({
                name: '',
                link: '',
                description: '',
            });
        },

        removeProject(index) {
            this.projects.splice(index, 1);
            if (!this.projects.length) this.addProject();
        },

        splitCommaList(value) {
            if (!value || typeof value !== 'string') return [];

            return value
                .split(',')
                .map((item) => item.trim())
                .filter(Boolean);
        },

        bulletLines(value) {
            if (!value || typeof value !== 'string') return [];

            return value
                .split('\n')
                .map((line) => line.replace(/^[•\-\*]\s*/, '').trim())
                .filter(Boolean);
        },

        normalizeText(value) {
            return (value || '')
                .toString()
                .toLowerCase()
                .replace(/[^\w\s%+-]/g, ' ')
                .replace(/\s+/g, ' ')
                .trim();
        },

        get skillsList() {
            return this.splitCommaList(this.skills);
        },

        get languageList() {
            return this.splitCommaList(this.languages);
        },

        get certificationList() {
            return this.splitCommaList(this.certifications);
        },

        get fullLocation() {
            const parts = [this.personal.city, this.personal.country]
                .map((value) => (value || '').trim())
                .filter(Boolean);

            return parts.join(', ');
        },

        hasExperienceEntry(job) {
            return Boolean(
                (job.role && job.role.trim()) ||
                (job.company && job.company.trim()) ||
                (job.location && job.location.trim()) ||
                (job.startDate && job.startDate.trim()) ||
                (job.endDate && job.endDate.trim()) ||
                this.bulletLines(job.bullets).length
            );
        },

        hasEducationEntry(item) {
            return Boolean(
                (item.school && item.school.trim()) ||
                (item.degree && item.degree.trim()) ||
                (item.field && item.field.trim()) ||
                (item.startDate && item.startDate.trim()) ||
                (item.endDate && item.endDate.trim())
            );
        },

        hasProjectEntry(project) {
            return Boolean(
                (project.name && project.name.trim()) ||
                (project.link && project.link.trim()) ||
                (project.description && project.description.trim())
            );
        },

        get validExperience() {
            return this.experience.filter((job) => this.hasExperienceEntry(job));
        },

        get validEducation() {
            return this.education.filter((item) => this.hasEducationEntry(item));
        },

        get validProjects() {
            return this.projects.filter((project) => this.hasProjectEntry(project));
        },

        get completedExperienceCount() {
            return this.validExperience.length;
        },

        get completedEducationCount() {
            return this.validEducation.length;
        },

        get projectCount() {
            return this.validProjects.length;
        },

        get allBulletTexts() {
            return this.validExperience.flatMap((job) => this.bulletLines(job.bullets));
        },

        isStrongBulletText(text) {
            const value = (text || '').toLowerCase();

            return (
                /\d/.test(value) ||
                value.includes('%') ||
                this.strongVerbs.some((verb) => value.includes(verb))
            );
        },

        isWeakBulletText(text) {
            const value = (text || '').toLowerCase();
            return this.weakPhrases.some((phrase) => value.includes(phrase));
        },

        isQuantifiedBulletText(text) {
            return /\d|%/.test(text || '');
        },

        get strongBulletCount() {
            return this.allBulletTexts.filter((bullet) => this.isStrongBulletText(bullet)).length;
        },

        get weakBulletCount() {
            return this.allBulletTexts.filter((bullet) => this.isWeakBulletText(bullet)).length;
        },

        get quantifiedBulletCount() {
            return this.allBulletTexts.filter((bullet) => this.isQuantifiedBulletText(bullet)).length;
        },

        jobStrongBulletCount(job) {
            return this.bulletLines(job.bullets).filter((bullet) => this.isStrongBulletText(bullet)).length;
        },

        jobQuantifiedBulletCount(job) {
            return this.bulletLines(job.bullets).filter((bullet) => this.isQuantifiedBulletText(bullet)).length;
        },

        jobBulletSuggestions(job) {
            const bullets = this.bulletLines(job.bullets);
            const suggestions = [];

            if (!bullets.length) {
                suggestions.push('Add achievement-focused bullet points to show your impact in this role.');
                return suggestions;
            }

            const weakCount = bullets.filter((bullet) => this.isWeakBulletText(bullet)).length;
            const quantifiedCount = bullets.filter((bullet) => this.isQuantifiedBulletText(bullet)).length;
            const strongCount = bullets.filter((bullet) => this.isStrongBulletText(bullet)).length;

            if (weakCount > 0) {
                suggestions.push('Replace weak phrases like “responsible for” with stronger action-led statements.');
            }

            if (quantifiedCount === 0) {
                suggestions.push('Add numbers, percentages, revenue, time saved, or team size to make this role more credible.');
            }

            if (strongCount < bullets.length) {
                suggestions.push('Start more bullet points with strong action verbs such as Led, Improved, Built, or Implemented.');
            }

            if (bullets.some((bullet) => bullet.length < 35)) {
                suggestions.push('Expand very short bullet points so they show both the action and the result.');
            }

            return suggestions.slice(0, 3);
        },

        get formattingScore() {
            let score = 0;

            if (this.personal.fullName.trim()) score += 4;
            if (this.personal.jobTitle.trim()) score += 4;
            if (this.personal.email.trim()) score += 3;
            if (this.personal.phone.trim()) score += 3;
            if (this.summary.trim().length >= 40) score += 4;
            if (this.completedExperienceCount >= 1) score += 6;
            if (this.completedEducationCount >= 1) score += 3;
            if (this.skillsList.length >= 4) score += 3;

            return Math.min(score, 30);
        },

        get contentImpactScore() {
            let score = 0;

            if (this.strongBulletCount >= 2) score += 8;
            else if (this.strongBulletCount >= 1) score += 4;

            if (this.quantifiedBulletCount >= 2) score += 8;
            else if (this.quantifiedBulletCount >= 1) score += 4;

            if (this.validProjects.length >= 1) score += 4;
            if (this.languageList.length >= 1) score += 2;
            if (this.certificationList.length >= 1) score += 2;
            if (this.weakBulletCount === 0 && this.allBulletTexts.length > 0) score += 6;

            return Math.min(score, 30);
        },

        get summaryLength() {
            return this.summary.trim().length;
        },

        get summaryKeywordHits() {
            if (!this.jobKeywords.length || !this.summary.trim()) return 0;

            const summaryText = this.normalizeText(this.summary);
            return this.jobKeywords.filter((keyword) => summaryText.includes(keyword)).length;
        },

        get summaryClarityScore() {
            let score = 0;

            if (this.summaryLength >= 60) score += 6;
            if (this.summaryLength >= 100) score += 6;
            if (this.summaryLength >= 150) score += 4;
            if (
                this.personal.jobTitle.trim() &&
                this.normalizeText(this.summary).includes(this.normalizeText(this.personal.jobTitle))
            ) score += 4;

            return Math.min(score, 20);
        },

        get summaryQualityScore() {
            const length = this.summary.trim().length;

            if (length >= 220) return 20;
            if (length >= 150) return 17;
            if (length >= 100) return 13;
            if (length >= 60) return 9;
            if (length >= 30) return 5;
            return 0;
        },

        get summaryStrengthLabel() {
            if (this.summaryClarityScore >= 17) return 'Strong';
            if (this.summaryClarityScore >= 10) return 'Good';
            return 'Needs Work';
        },

        get summarySuggestions() {
            const suggestions = [];

            if (this.summaryLength < 60) {
                suggestions.push('Make your summary longer and clearer by describing your background, strengths, and target role.');
            }

            if (this.summaryLength > 320) {
                suggestions.push('Shorten your summary slightly so it stays sharp and easy to scan.');
            }

            if (!this.personal.jobTitle.trim()) {
                suggestions.push('Add a target job title so your summary and role direction feel more focused.');
            }

            if (this.jobKeywords.length && this.summaryKeywordHits < 2) {
                suggestions.push('Add relevant keywords from the job description into your summary naturally.');
            }

            if (!/[0-9%]/.test(this.summary) && this.summaryLength >= 80) {
                suggestions.push('If relevant, add a measurable achievement or performance highlight to strengthen credibility.');
            }

            return suggestions.slice(0, 4);
        },

        extractJobKeywords(text) {
            if (!text || typeof text !== 'string') return [];

            const words = this.normalizeText(text)
                .split(' ')
                .filter((word) => word.length >= 4)
                .filter((word) => !this.ignoredKeywords.includes(word));

            const frequency = {};

            words.forEach((word) => {
                frequency[word] = (frequency[word] || 0) + 1;
            });

            return Object.entries(frequency)
                .sort((a, b) => b[1] - a[1])
                .slice(0, 15)
                .map(([word]) => word);
        },

        get resumeSearchText() {
            const parts = [
                this.personal.fullName,
                this.personal.jobTitle,
                this.summary,
                this.skills,
                this.languages,
                this.certifications,
                ...this.validExperience.flatMap((job) => [
                    job.role,
                    job.company,
                    job.location,
                    job.startDate,
                    job.endDate,
                    job.bullets,
                ]),
                ...this.validEducation.flatMap((item) => [
                    item.school,
                    item.degree,
                    item.field,
                    item.startDate,
                    item.endDate,
                ]),
                ...this.validProjects.flatMap((project) => [
                    project.name,
                    project.link,
                    project.description,
                ]),
            ]
                .filter(Boolean)
                .join(' ');

            return this.normalizeText(parts);
        },

        get jobKeywords() {
            return this.extractJobKeywords(this.jobDescription);
        },

        get matchedKeywords() {
            const text = this.resumeSearchText;
            return this.jobKeywords.filter((keyword) => text.includes(keyword));
        },

        get missingKeywords() {
            const text = this.resumeSearchText;
            return this.jobKeywords.filter((keyword) => !text.includes(keyword)).slice(0, 8);
        },

        get jobMatchRawScore() {
            if (!this.jobKeywords.length) return 0;
            return Math.round((this.matchedKeywords.length / this.jobKeywords.length) * 20);
        },

        get jobMatchScore() {
            if (!this.jobKeywords.length) return 'N/A';
            return `${Math.min(this.jobMatchRawScore * 5, 100)}%`;
        },

        get atsReadinessScore() {
            return Math.min(
                this.formattingScore + this.contentImpactScore + this.summaryQualityScore + this.jobMatchRawScore,
                100
            );
        },

        get atsScore() {
            return this.atsReadinessScore;
        },

        get scoreLabel() {
            if (this.atsScore >= 90) return 'Excellent';
            if (this.atsScore >= 75) return 'Strong';
            if (this.atsScore >= 60) return 'Good';
            return 'Needs Improvement';
        },

        get scoreColor() {
            if (this.atsScore >= 90) return 'bg-emerald-500';
            if (this.atsScore >= 75) return 'bg-blue-600';
            if (this.atsScore >= 60) return 'bg-amber-500';
            return 'bg-rose-500';
        },

        get scoreWidth() {
            return `${this.atsScore}%`;
        },

        get scoreBreakdown() {
            const items = [
                { label: 'Formatting & Completeness', score: this.formattingScore, max: 30 },
                { label: 'Content Impact', score: this.contentImpactScore, max: 30 },
                { label: 'Summary Quality', score: this.summaryQualityScore, max: 20 },
                { label: 'Job Match', score: this.jobMatchRawScore, max: 20 },
            ];

            return items.map((item) => ({
                ...item,
                width: `${(item.score / item.max) * 100}%`,
            }));
        },

        get quickTips() {
            const tips = [];

            if (!this.personal.fullName.trim()) {
                tips.push('Add your full name to complete the resume header.');
            }

            if (!this.personal.jobTitle.trim()) {
                tips.push('Add a target job title to make your resume more focused.');
            }

            if (this.summary.trim().length < 60) {
                tips.push('Write a stronger professional summary with a clearer value proposition.');
            }

            if (this.skillsList.length < 4) {
                tips.push('Add more relevant core skills that match your target role.');
            }

            if (this.completedExperienceCount < 1) {
                tips.push('Include at least one work experience entry.');
            }

            if (this.strongBulletCount < 2) {
                tips.push('Use achievement-focused bullet points with strong action verbs.');
            }

            return tips.slice(0, 4);
        },

        get bulletSuggestions() {
            const suggestions = [];

            if (this.allBulletTexts.length === 0) {
                suggestions.push('Add bullet points to your work experience so recruiters can quickly understand your impact.');
                return suggestions;
            }

            if (this.weakBulletCount > 0) {
                suggestions.push('Replace weak phrases like “responsible for” or “helped with” with more direct action verbs.');
            }

            if (this.quantifiedBulletCount < 2) {
                suggestions.push('Use numbers, percentages, revenue, response time, growth, or team size to make your experience stronger.');
            }

            if (this.strongBulletCount < this.allBulletTexts.length) {
                suggestions.push('Start more bullets with stronger action verbs such as Led, Improved, Created, Built, or Implemented.');
            }

            if (this.allBulletTexts.some((bullet) => bullet.length < 35)) {
                suggestions.push('Expand short bullet points so they include both the action and the result.');
            }

            return suggestions.slice(0, 4);
        },

        get improvementSuggestions() {
            const suggestions = [];

            if (this.weakBulletCount > 0) {
                suggestions.push('Replace weak phrases like “responsible for” with stronger action verbs such as “Led,” “Improved,” or “Developed.”');
            }

            if (this.quantifiedBulletCount < 2 && this.allBulletTexts.length > 0) {
                suggestions.push('Add measurable results to your bullet points using numbers, percentages, time saved, revenue, growth, or team size.');
            }

            if (this.summary.trim().length < 100) {
                suggestions.push('Expand your summary to briefly cover your experience, strengths, and the value you bring to the target role.');
            }

            if (this.jobKeywords.length && this.missingKeywords.length) {
                suggestions.push('Add the most relevant missing job keywords naturally into your summary, skills, or work experience sections.');
            }

            if (this.skillsList.length < 6) {
                suggestions.push('Increase your core skills list with role-specific tools, systems, or technical abilities.');
            }

            if (!this.validProjects.length && this.completedExperienceCount < 2) {
                suggestions.push('Add a project section to strengthen your resume if your professional experience is still limited.');
            }

            return suggestions.slice(0, 5);
        },

        buildPayload() {
            return {
                personal: {
                    ...this.personal,
                },
                summary: this.summary,
                skills: this.skillsList,
                languages: this.languageList,
                certifications: this.certificationList,
                experience: this.experience.map((job) => ({
                    role: job.role || '',
                    company: job.company || '',
                    location: job.location || '',
                    startDate: job.startDate || '',
                    endDate: job.current ? '' : (job.endDate || ''),
                    current: Boolean(job.current),
                    bullets: this.bulletLines(job.bullets),
                })),
                education: this.education.map((item) => ({
                    school: item.school || '',
                    degree: item.degree || '',
                    field: item.field || '',
                    startDate: item.startDate || '',
                    endDate: item.endDate || '',
                })),
                projects: this.projects.map((project) => ({
                    name: project.name || '',
                    link: project.link || '',
                    description: project.description || '',
                })),
            };
        },

        async downloadPdf() {
            if (this.downloading) return;

            if (this.hasValidationErrors) {
                alert('Please fix the highlighted fields before downloading your PDF.');
                return;
            }

            this.downloading = true;

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const payload = this.buildPayload();

                const response = await fetch('/tools/resume-builder/pdf', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf, application/json, text/plain, */*',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': token,
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload),
                });

                const contentType = response.headers.get('content-type') || '';

                if (!response.ok) {
                    let message = 'Unable to generate PDF right now. Please review your details and try again.';

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

                if (!contentType.includes('application/pdf')) {
                    const text = await response.text();
                    console.error('Expected PDF but received:', text);
                    throw new Error('The server returned a page instead of a PDF. Please check the PDF route and controller response.');
                }

                const blob = await response.blob();
                const objectUrl = window.URL.createObjectURL(blob);
                const link = document.createElement('a');

                link.href = objectUrl;
                link.download = this.makeDownloadFilename();
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                setTimeout(() => {
                    window.URL.revokeObjectURL(objectUrl);
                }, 2000);

                if (typeof window.trackToolUsage === 'function') {
                    window.trackToolUsage('resume-builder', 'file_download', {
                        format: 'pdf',
                        template: this.selectedTemplate,
                        ats_score: this.atsScore,
                        job_match_score: this.jobMatchScore,
                    });
                }
            } catch (error) {
                console.error('Resume PDF download failed:', error);
                alert(error.message || 'Unable to generate your PDF right now. Please try again.');
            } finally {
                this.downloading = false;
            }
        },

        makeDownloadFilename() {
            const name = (this.personal.fullName || 'resume')
                .trim()
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '') || 'resume';

            return `${name}-resume.pdf`;
        },

        async copyResume() {
            try {
                const text = this.buildResumeText();
                await navigator.clipboard.writeText(text);

                this.copied = true;

                if (typeof window.trackToolUsage === 'function') {
                    window.trackToolUsage('resume-builder', 'copy');
                }

                setTimeout(() => {
                    this.copied = false;
                }, 2000);
            } catch (error) {
                console.error('Resume copy failed:', error);
                alert('Unable to copy your resume right now.');
            }
        },

        buildResumeText() {
            const lines = [];

            if (this.personal.fullName) lines.push(this.personal.fullName);
            if (this.personal.jobTitle) lines.push(this.personal.jobTitle);

            const contacts = [
                this.personal.email,
                this.personal.phone,
                this.fullLocation,
                this.personal.website,
                this.personal.linkedin,
            ].filter(Boolean);

            if (contacts.length) {
                lines.push(contacts.join(' | '));
            }

            if (this.summary.trim()) {
                lines.push('');
                lines.push('PROFESSIONAL SUMMARY');
                lines.push(this.summary.trim());
            }

            if (this.skillsList.length) {
                lines.push('');
                lines.push('CORE SKILLS');
                lines.push(this.skillsList.join(', '));
            }

            if (this.validExperience.length) {
                lines.push('');
                lines.push('WORK EXPERIENCE');

                this.validExperience.forEach((job) => {
                    lines.push(`${job.role || ''}${job.company ? ' - ' + job.company : ''}`.trim());

                    const meta = [
                        job.location,
                        job.startDate,
                        job.current ? 'Present' : job.endDate,
                    ].filter(Boolean).join(' | ');

                    if (meta) lines.push(meta);

                    this.bulletLines(job.bullets).forEach((bullet) => {
                        lines.push(`• ${bullet}`);
                    });

                    lines.push('');
                });
            }

            if (this.validEducation.length) {
                lines.push('EDUCATION');

                this.validEducation.forEach((item) => {
                    lines.push(`${item.degree || ''}${item.field ? ', ' + item.field : ''}`.trim());
                    if (item.school) lines.push(item.school);
                    const dateRange = [item.startDate, item.endDate].filter(Boolean).join(' - ');
                    if (dateRange) lines.push(dateRange);
                    lines.push('');
                });
            }

            if (this.validProjects.length) {
                lines.push('PROJECTS');

                this.validProjects.forEach((project) => {
                    if (project.name) lines.push(project.name);
                    if (project.link) lines.push(project.link);
                    if (project.description) lines.push(project.description);
                    lines.push('');
                });
            }

            if (this.languageList.length) {
                lines.push('LANGUAGES');
                this.languageList.forEach((language) => lines.push(language));
                lines.push('');
            }

            if (this.certificationList.length) {
                lines.push('CERTIFICATIONS');
                this.certificationList.forEach((cert) => lines.push(cert));
                lines.push('');
            }

            return lines.join('\n').trim();
        },

        printResume() {
            if (typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('resume-builder', 'print');
            }

            window.print();
        },

        clearAll() {
            const confirmed = window.confirm('Clear all resume details and start again?');
            if (!confirmed) return;

            this.selectedTemplate = 'professional';
            this.copied = false;
            this.downloading = false;

            this.personal = {
                fullName: '',
                jobTitle: '',
                email: '',
                phone: '',
                city: '',
                country: '',
                website: '',
                linkedin: '',
            };

            this.summary = '';
            this.skills = '';
            this.languages = '';
            this.certifications = '';
            this.jobDescription = '';

            this.experience = [
                {
                    role: '',
                    company: '',
                    location: '',
                    startDate: '',
                    endDate: '',
                    current: false,
                    bullets: '',
                },
            ];

            this.education = [
                {
                    school: '',
                    degree: '',
                    field: '',
                    startDate: '',
                    endDate: '',
                },
            ];

            this.projects = [
                {
                    name: '',
                    link: '',
                    description: '',
                },
            ];

            try {
                localStorage.removeItem('toolnova_resume_builder');
            } catch (error) {
                console.warn('Resume Builder storage clear failed.', error);
            }

            if (typeof window.trackToolUsage === 'function') {
                window.trackToolUsage('resume-builder', 'clear');
            }
        },
    };
}

window.resumeBuilder = resumeBuilder;