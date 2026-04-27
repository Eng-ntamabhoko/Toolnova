<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ ($data['personal']['fullName'] ?? 'Resume') . ' Resume' }}</title>
    <style>
        @page {
            margin: 22px 24px 26px 24px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: #0f172a;
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 11px;
            line-height: 1.65;
        }

        .resume {
            width: 100%;
        }

        .top-bar {
    height: 10px;
    width: 100%;
    background: linear-gradient(90deg, #2563eb, #1d4ed8);
    border-radius: 8px;
    margin-bottom: 20px;
}

        .header {
            margin-bottom: 18px;
            padding-bottom: 16px;
            border-bottom: 1px solid #dbe3ee;
        }

        .name {
            margin: 0;
            font-size: 30px;
            line-height: 1.02;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: 0.2px;
        }

        .title {
            margin: 6px 0 0 0;
            font-size: 13.2px;
            line-height: 1.35;
            font-weight: 700;
            color: #2563eb;
        }

        .contact-line {
            margin-top: 10px;
            font-size: 10.4px;
            line-height: 1.55;
            color: #475569;
        }

        .section {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .section-alt {
            padding: 10px 12px;
            background: #fafafa;
            border-radius: 10px;
        }

        .section-title {
            margin: 0 0 10px 0;
            padding-bottom: 6px;
            border-bottom: 3px solid #2563eb;
            font-size: 10.6px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: #1e3a8a;
        }

        .summary-panel {
            padding: 11px 13px;
            background: #f8fafc;
            border-left: 4px solid #2563eb;
            border-radius: 0 10px 10px 0;
        }

        .summary-text {
            margin: 0;
            color: #1e293b;
            line-height: 1.65;
        }

        .chips {
            margin-top: 2px;
        }

        .chip {
            display: inline-block;
            margin: 0 7px 7px 0;
            padding: 5px 10px;
            border-radius: 999px;
            border: 1px solid #dbeafe;
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 10px;
            line-height: 1.2;
            font-weight: 700;
        }

        .entry {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .entry:last-child {
            margin-bottom: 0;
        }

        .entry-card {
            border: 1px solid #e5e7eb;
            border-left: 4px solid #2563eb;
            border-radius: 12px;
            background: #ffffff;
            padding: 13px 14px 13px 12px;
        }

        .entry-title {
            margin: 0;
            font-size: 13.5px;
            line-height: 1.35;
            font-weight: 800;
            color: #111827;
        }

        .entry-company {
            margin: 2px 0 0 0;
            font-size: 11px;
            line-height: 1.4;
            font-weight: 700;
            color: #2563eb;
        }

        .entry-meta {
            margin: 4px 0 0 0;
            font-size: 10px;
            line-height: 1.45;
            color: #64748b;
        }

        .bullets {
            margin: 9px 0 0 0;
            padding-left: 16px;
        }

        .bullets li {
            margin-bottom: 5px;
            color: #1f2937;
            line-height: 1.6;
        }

        .bullets li:last-child {
            margin-bottom: 0;
        }

        .edu-item,
        .project-item,
        .side-box {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #ffffff;
        }

        .edu-item {
            margin-bottom: 11px;
            padding: 11px 13px;
        }

        .edu-item:last-child {
            margin-bottom: 0;
        }

        .edu-title {
            margin: 0;
            font-size: 11.4px;
            font-weight: 800;
            color: #111827;
        }

        .edu-meta {
            margin: 4px 0 0 0;
            font-size: 10px;
            line-height: 1.45;
            color: #64748b;
        }

        .project-item {
            margin-bottom: 11px;
            padding: 11px 13px;
        }

        .project-item:last-child {
            margin-bottom: 0;
        }

        .project-title {
            margin: 0;
            font-size: 11.4px;
            font-weight: 800;
            color: #111827;
        }

        .project-link {
            margin: 4px 0 0 0;
            font-size: 10px;
            color: #2563eb;
            line-height: 1.35;
            word-break: break-word;
        }

        .project-description {
            margin: 6px 0 0 0;
            color: #1f2937;
            line-height: 1.6;
        }

        .two-col {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 16px;
        }

        .two-col td {
            width: 50%;
            vertical-align: top;
        }

        .two-col td:first-child {
            padding-right: 8px;
        }

        .two-col td:last-child {
            padding-left: 8px;
        }

        .side-box {
            padding: 11px 13px;
        }

        .side-title {
            margin: 0 0 8px 0;
            padding-bottom: 6px;
            border-bottom: 3px solid #2563eb;
            font-size: 10.4px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #1e3a8a;
        }

        .mini-list {
            margin: 0;
            padding-left: 15px;
        }

        .mini-list li {
            margin-bottom: 4px;
            color: #1f2937;
            line-height: 1.5;
        }

        .mini-list li:last-child {
            margin-bottom: 0;
        }
        .entry-card,
.edu-item,
.project-item,
.side-box {
    box-shadow: 0 1px 2px rgba(0,0,0,0.04);
}
    </style>
</head>
<body>
@php
    $personal = $data['personal'] ?? [];
    $summary = trim((string) ($data['summary'] ?? ''));

    $skills = is_array($data['skills'] ?? null) ? array_values(array_filter($data['skills'])) : [];
    $languages = is_array($data['languages'] ?? null) ? array_values(array_filter($data['languages'])) : [];
    $certifications = is_array($data['certifications'] ?? null) ? array_values(array_filter($data['certifications'])) : [];
    $experience = is_array($data['experience'] ?? null) ? array_values(array_filter($data['experience'])) : [];
    $education = is_array($data['education'] ?? null) ? array_values(array_filter($data['education'])) : [];
    $projects = is_array($data['projects'] ?? null) ? array_values(array_filter($data['projects'])) : [];

    $location = trim(implode(', ', array_filter([
        $personal['city'] ?? '',
        $personal['country'] ?? '',
    ])));

    $contactParts = array_values(array_filter([
        $personal['email'] ?? '',
        $personal['phone'] ?? '',
        $location,
        $personal['website'] ?? '',
        $personal['linkedin'] ?? '',
    ]));

    $hasExtras = !empty($languages) || !empty($certifications);
@endphp

<div class="resume">
    <div class="top-bar"></div>

    <div class="header">
        <h1 class="name">{{ $personal['fullName'] ?? 'Your Name' }}</h1>

        @if(!empty($personal['jobTitle']))
            <p class="title">{{ $personal['jobTitle'] }}</p>
        @endif

        @if(!empty($contactParts))
            <div class="contact-line">
                {{ implode(' • ', $contactParts) }}
            </div>
        @endif
    </div>

    @if($summary !== '')
        <div class="section">
            <h2 class="section-title">Professional Summary</h2>
            <div class="summary-panel">
                <p class="summary-text">{{ $summary }}</p>
            </div>
        </div>
    @endif

    @if(!empty($skills))
        <div class="section section-alt">
            <h2 class="section-title">Core Skills</h2>
            <div class="chips">
                @foreach($skills as $skill)
                    <span class="chip">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
    @endif

    @if(!empty($experience))
        <div class="section">
            <h2 class="section-title">Work Experience</h2>

            @foreach($experience as $job)
                @php
                    $role = trim((string) ($job['role'] ?? ''));
                    $company = trim((string) ($job['company'] ?? ''));
                    $jobLocation = trim((string) ($job['location'] ?? ''));
                    $startDate = trim((string) ($job['startDate'] ?? ''));
                    $endDate = !empty($job['current']) ? 'Present' : trim((string) ($job['endDate'] ?? ''));
                    $bullets = is_array($job['bullets'] ?? null) ? array_values(array_filter($job['bullets'])) : [];
                    $metaParts = array_values(array_filter([
                        trim(implode(' - ', array_filter([$startDate, $endDate]))),
                        $jobLocation,
                    ]));
                @endphp

                @if($role !== '' || $company !== '' || !empty($bullets))
                    <div class="entry">
                        <div class="entry-card">
                            <p class="entry-title">{{ $role !== '' ? $role : 'Professional Experience' }}</p>

                            @if($company !== '')
                                <p class="entry-company">{{ $company }}</p>
                            @endif

                            @if(!empty($metaParts))
                                <p class="entry-meta">{{ implode(' • ', $metaParts) }}</p>
                            @endif

                            @if(!empty($bullets))
                                <ul class="bullets">
                                    @foreach($bullets as $bullet)
                                        <li>{{ $bullet }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @if(!empty($education))
        <div class="section section-alt">
            <h2 class="section-title">Education</h2>

            @foreach($education as $item)
                @php
                    $degree = trim((string) ($item['degree'] ?? ''));
                    $field = trim((string) ($item['field'] ?? ''));
                    $school = trim((string) ($item['school'] ?? ''));
                    $startDate = trim((string) ($item['startDate'] ?? ''));
                    $endDate = trim((string) ($item['endDate'] ?? ''));

                    $eduTitle = $degree;
                    if ($field !== '') {
                        $eduTitle = $eduTitle !== '' ? $eduTitle . ', ' . $field : $field;
                    }

                    $eduMeta = trim(implode(' • ', array_filter([
                        $school,
                        trim(implode(' - ', array_filter([$startDate, $endDate]))),
                    ])));
                @endphp

                @if($eduTitle !== '' || $school !== '')
                    <div class="edu-item">
                        <p class="edu-title">{{ $eduTitle !== '' ? $eduTitle : 'Education' }}</p>

                        @if($eduMeta !== '')
                            <p class="edu-meta">{{ $eduMeta }}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @if(!empty($projects))
        <div class="section">
            <h2 class="section-title">Projects</h2>

            @foreach($projects as $project)
                @php
                    $projectName = trim((string) ($project['name'] ?? ''));
                    $projectLink = trim((string) ($project['link'] ?? ''));
                    $projectDescription = trim((string) ($project['description'] ?? ''));
                @endphp

                @if($projectName !== '' || $projectDescription !== '')
                    <div class="project-item">
                        <p class="project-title">{{ $projectName !== '' ? $projectName : 'Project' }}</p>

                        @if($projectLink !== '')
                            <p class="project-link">{{ $projectLink }}</p>
                        @endif

                        @if($projectDescription !== '')
                            <p class="project-description">{{ $projectDescription }}</p>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @if($hasExtras)
        <table class="two-col">
            <tr>
                <td>
                    @if(!empty($languages))
                        <div class="side-box">
                            <h2 class="side-title">Languages</h2>
                            <ul class="mini-list">
                                @foreach($languages as $language)
                                    <li>{{ $language }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </td>

                <td>
                    @if(!empty($certifications))
                        <div class="side-box">
                            <h2 class="side-title">Certifications</h2>
                            <ul class="mini-list">
                                @foreach($certifications as $certification)
                                    <li>{{ $certification }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    @endif
</div>
</body>
</html>