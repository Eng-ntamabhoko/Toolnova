<!DOCTYPE html>
<html xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.4;
            color: #000000;
            background: #ffffff;
        }
        .cv-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #ffffff;
        }
        .cv-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .cv-title {
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .full-name {
            font-size: 16pt;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .profession-title {
            font-size: 14pt;
            color: #333333;
        }
        .cv-section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
            border-bottom: 1px solid #000000;
            padding-bottom: 2px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
            padding-right: 10px;
        }
        .edu-table, .lang-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000000;
            margin-top: 8px;
        }
        .edu-table th, .lang-table th,
        .edu-table td, .lang-table td {
            border: 1px solid #000000;
            padding: 6px;
            font-size: 11pt;
            text-align: left;
        }
        .edu-table th, .lang-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .experience-item, .certification-item, .project-item, .referee-item {
            margin-bottom: 10px;
        }
        .experience-title, .certification-title, .project-title, .referee-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        .experience-period, .certification-period, .project-period {
            font-size: 11pt;
            color: #666666;
            margin-bottom: 3px;
        }
        .experience-description, .project-description {
            font-size: 11pt;
            line-height: 1.4;
        }
        .skills-list, .additional-skills-list, .interests-list {
            margin-top: 8px;
        }
        .skills-list li, .additional-skills-list li, .interests-list li {
            margin-bottom: 2px;
            font-size: 11pt;
        }
        .signature-space {
            margin-top: 15px;
            border-top: 1px solid #000000;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature-label {
            font-weight: bold;
            font-size: 11pt;
        }
        .signature-image {
            max-width: 200px;
            max-height: 60px;
            border: 1px solid #cccccc;
        }
        .signature-placeholder {
            width: 200px;
            height: 40px;
            border-bottom: 1px solid #000000;
        }
        .date-section {
            text-align: right;
        }
        .date-label {
            font-weight: bold;
            font-size: 11pt;
            margin-bottom: 5px;
        }
        .date-value {
            border-bottom: 1px solid #000000;
            width: 120px;
            text-align: center;
            padding: 2px;
            font-size: 11pt;
        }
    </style>
</head>
<body>

<div class="cv-container">

    {{-- Header --}}
    @php
        $fullName = trim(implode(' ', array_filter([
            $data['personal']['surname'] ?? '',
            $data['personal']['firstName'] ?? '',
            $data['personal']['otherNames'] ?? '',
        ])));
    @endphp

    <div class="cv-header">
        <div class="cv-title">Curriculum Vitae</div>
        @if($fullName)
            <div class="full-name">{{ $fullName }}</div>
        @endif
    </div>

    {{-- Personal Information --}}
    @php
        $hasPersonalInfo = !empty($data['personal']['surname']) ||
                          !empty($data['personal']['firstName']) ||
                          !empty($data['personal']['otherNames']) ||
                          !empty($data['personal']['sex']) ||
                          !empty($data['personal']['maritalStatus']) ||
                          !empty($data['personal']['birthDate']) ||
                          !empty($data['personal']['nationality']) ||
                          !empty($data['contact']['address']) ||
                          !empty($data['contact']['mobile1']) ||
                          !empty($data['contact']['mobile2']) ||
                          !empty($data['contact']['email']);
    @endphp

    @if($hasPersonalInfo)
        <div class="cv-section">
            <div class="section-title">Personal Information</div>
            <table class="info-table">
                @if($data['personal']['surname'] ?? false)
                    <tr>
                        <td class="info-label">Surname</td>
                        <td>: {{ $data['personal']['surname'] }}</td>
                    </tr>
                @endif
                @if($data['personal']['firstName'] ?? false)
                    <tr>
                        <td class="info-label">First name</td>
                        <td>: {{ $data['personal']['firstName'] }}</td>
                    </tr>
                @endif
                @if($data['personal']['otherNames'] ?? false)
                    <tr>
                        <td class="info-label">Other names</td>
                        <td>: {{ $data['personal']['otherNames'] }}</td>
                    </tr>
                @endif
                @if($data['personal']['sex'] ?? false)
                    <tr>
                        <td class="info-label">Sex</td>
                        <td>: {{ $data['personal']['sex'] }}</td>
                    </tr>
                @endif
                @if($data['personal']['maritalStatus'] ?? false)
                    <tr>
                        <td class="info-label">Marital Status</td>
                        <td>: {{ $data['personal']['maritalStatus'] }}</td>
                    </tr>
                @endif
                @if($data['personal']['birthDate'] ?? false)
                    <tr>
                        <td class="info-label">Birth date</td>
                        <td>: {{ $data['personal']['birthDate'] }}</td>
                    </tr>
                @endif
                @if($data['personal']['nationality'] ?? false)
                    <tr>
                        <td class="info-label">Nationality</td>
                        <td>: {{ $data['personal']['nationality'] }}</td>
                    </tr>
                @endif
                @if($data['contact']['address'] ?? false)
                    <tr>
                        <td class="info-label">Contact address</td>
                        <td>: {{ $data['contact']['address'] }}</td>
                    </tr>
                @endif
                @if($data['contact']['mobile1'] ?? false || $data['contact']['mobile2'] ?? false)
                    <tr>
                        <td class="info-label">Mobile</td>
                        <td>: {{ collect([$data['contact']['mobile1'] ?? null, $data['contact']['mobile2'] ?? null])->filter()->implode(', ') }}</td>
                    </tr>
                @endif
                @if($data['contact']['email'] ?? false)
                    <tr>
                        <td class="info-label">E-mail</td>
                        <td>: {{ $data['contact']['email'] }}</td>
                    </tr>
                @endif
            </table>
        </div>
    @endif

    {{-- Education Background --}}
    @if($data['education'] ?? false)
        <div class="cv-section">
            <div class="section-title">Education Background</div>
            <table class="edu-table">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Course / Combination</th>
                        <th>College / School</th>
                        <th>Place / Country</th>
                        <th>Award</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['education'] as $edu)
                        <tr>
                            <td>{{ $edu['year'] ?? '-' }}</td>
                            <td>{{ $edu['course'] ?? '-' }}</td>
                            <td>{{ $edu['institution'] ?? '-' }}</td>
                            <td>{{ $edu['place'] ?? '-' }}</td>
                            <td>{{ $edu['award'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Working Experience --}}
    @if($data['experience'] ?? false)
        <div class="cv-section">
            <div class="section-title">Working Experience</div>
            @foreach($data['experience'] as $exp)
                <div class="experience-item">
                    <div class="experience-title">{{ $exp['title'] ?? 'Position' }} @if($exp['organization'] ?? false) - {{ $exp['organization'] }} @endif</div>
                    @if($exp['period'] ?? false)
                        <div class="experience-period">{{ $exp['period'] }}</div>
                    @endif
                    @if($exp['description'] ?? false)
                        <div class="experience-description">{{ $exp['description'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- Skills / Ability --}}
    @if($data['skills'] ?? false)
        <div class="cv-section">
            <div class="section-title">Skills / Ability</div>
            <ul class="skills-list">
                @foreach($data['skills'] as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Extra Knowledge --}}
    @if($data['additionalSkills'] ?? false)
        <div class="cv-section">
            <div class="section-title">Extra Knowledge</div>
            <ul class="additional-skills-list">
                @foreach($data['additionalSkills'] as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Language Skills --}}
    @if($data['languages'] ?? false)
        <div class="cv-section">
            <div class="section-title">Language Skills</div>
            <table class="lang-table">
                <thead>
                    <tr>
                        <th>Language</th>
                        <th>Reading</th>
                        <th>Writing</th>
                        <th>Speaking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['languages'] as $lang)
                        <tr>
                            <td>{{ $lang['language'] ?? '-' }}</td>
                            <td>{{ $lang['reading'] ?? '-' }}</td>
                            <td>{{ $lang['writing'] ?? '-' }}</td>
                            <td>{{ $lang['speaking'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Interests / Hobbies --}}
    @if($data['interests'] ?? false)
        <div class="cv-section">
            <div class="section-title">Interests / Hobbies</div>
            <ul class="interests-list">
                @foreach($data['interests'] as $interest)
                    <li>{{ $interest }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Referees --}}
    @if($data['referees'] ?? false)
        <div class="cv-section">
            <div class="section-title">Referees</div>
            @foreach($data['referees'] as $ref)
                <div class="referee-item">
                    <div class="referee-name">{{ $ref['name'] ?? 'Referee' }}</div>
                    @if($ref['title'] ?? false)
                        <div>{{ $ref['title'] }}</div>
                    @endif
                    @if($ref['organization'] ?? false)
                        <div>{{ $ref['organization'] }}</div>
                    @endif
                    @if($ref['address'] ?? false)
                        <div>{{ $ref['address'] }}</div>
                    @endif
                    @if($ref['mobile'] ?? false)
                        <div>{{ $ref['mobile'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- Declaration --}}
    @if($data['declaration'] ?? false)
        <div class="cv-section">
            <div class="section-title">Declaration</div>
            <p style="font-size: 11pt; line-height: 1.4; margin-bottom: 15px;">{{ $data['declaration'] }}</p>

            <div class="signature-space">
                <div>
                    <div class="signature-label">Signature:</div>
                    @if(!empty($data['signatureDataUrl']))
                        <img src="{{ $data['signatureDataUrl'] }}" alt="Signature" class="signature-image" />
                    @else
                        <div class="signature-placeholder"></div>
                    @endif
                </div>
                <div class="date-section">
                    <div class="date-label">Date:</div>
                    <div class="date-value">{{ !empty($data['useTodayDate']) ? now()->format('d/m/Y') : ($data['signatureDate'] ?? '____________________') }}</div>
                </div>
            </div>
        </div>
    @endif

</div>

</body>
</html>
