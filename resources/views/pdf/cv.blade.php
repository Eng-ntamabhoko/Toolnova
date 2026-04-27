<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Curriculum Vitae</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            line-height: 1.5;
            color: #000;
            margin: 28px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .section {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-bottom: 8px;
        }

        .info-table,
        .grid-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .grid-table th,
        .grid-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .grid-table th {
            font-weight: bold;
        }

        .list {
            margin: 0;
            padding-left: 18px;
        }

        .list li {
            margin-bottom: 4px;
        }

        .block-item {
            margin-bottom: 10px;
        }

        .signature-wrap {
            margin-top: 24px;
        }

        .signature-line {
            margin-top: 18px;
            width: 180px;
            border-bottom: 1px solid #000;
            height: 28px;
        }

        .signature-image {
            max-width: 160px;
            max-height: 60px;
        }

        .date-wrap {
            margin-top: 16px;
        }
    </style>
</head>
<body>
    @php
        $personal = $data['personal'] ?? [];
        $contact = $data['contact'] ?? [];
        $education = $data['education'] ?? [];
        $experience = $data['experience'] ?? [];
        $skills = $data['skills'] ?? [];
        $additionalSkills = $data['additionalSkills'] ?? [];
        $languages = $data['languages'] ?? [];
        $interests = $data['interests'] ?? [];
        $referees = $data['referees'] ?? [];
        $declaration = $data['declaration'] ?? '';
        $signatureDataUrl = $data['signatureDataUrl'] ?? '';
        $signatureDate = $data['useTodayDate'] ?? false
            ? now()->format('d/m/Y')
            : ($data['signatureDate'] ?? '');
    @endphp

    <div class="title">Curriculum Vitae</div>

    @if(
        !empty($personal['surname']) ||
        !empty($personal['firstName']) ||
        !empty($personal['otherNames']) ||
        !empty($personal['nationality']) ||
        !empty($personal['birthDate']) ||
        !empty($personal['sex']) ||
        !empty($personal['maritalStatus'])
    )
        <div class="section">
            <div class="section-title">1.0 Personal Details</div>
            <table class="info-table">
                @if(!empty($personal['surname']))
                    <tr><td class="label">Surname</td><td>: {{ $personal['surname'] }}</td></tr>
                @endif
                @if(!empty($personal['firstName']))
                    <tr><td class="label">First Name</td><td>: {{ $personal['firstName'] }}</td></tr>
                @endif
                @if(!empty($personal['otherNames']))
                    <tr><td class="label">Other Names</td><td>: {{ $personal['otherNames'] }}</td></tr>
                @endif
                @if(!empty($personal['nationality']))
                    <tr><td class="label">Nationality</td><td>: {{ $personal['nationality'] }}</td></tr>
                @endif
                @if(!empty($personal['birthDate']))
                    <tr><td class="label">Date of Birth</td><td>: {{ $personal['birthDate'] }}</td></tr>
                @endif
                @if(!empty($personal['sex']))
                    <tr><td class="label">Sex</td><td>: {{ $personal['sex'] }}</td></tr>
                @endif
                @if(!empty($personal['maritalStatus']))
                    <tr><td class="label">Marital Status</td><td>: {{ $personal['maritalStatus'] }}</td></tr>
                @endif
            </table>
        </div>
    @endif

    @if(!empty($contact['address']) || !empty($contact['mobile1']) || !empty($contact['mobile2']) || !empty($contact['email']))
        <div class="section">
            <div class="section-title">2.0 Contact Details</div>
            <table class="info-table">
                @if(!empty($contact['address']))
                    <tr><td class="label">Address</td><td>: {{ $contact['address'] }}</td></tr>
                @endif
                @if(!empty($contact['mobile1']) || !empty($contact['mobile2']))
                    <tr><td class="label">Mobile Number</td><td>: {{ implode(', ', array_filter([$contact['mobile1'] ?? '', $contact['mobile2'] ?? ''])) }}</td></tr>
                @endif
                @if(!empty($contact['email']))
                    <tr><td class="label">E-mail</td><td>: {{ $contact['email'] }}</td></tr>
                @endif
            </table>
        </div>
    @endif

    @if(!empty($education))
        <div class="section">
            <div class="section-title">3.0 Education Background</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Institution / School</th>
                        <th>Award / Course</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($education as $item)
                        <tr>
                            <td>{{ $item['year'] ?? '' }}</td>
                            <td>{{ $item['institution'] ?? '' }}</td>
                            <td>{{ $item['awardCourse'] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if(!empty($experience))
        <div class="section">
            <div class="section-title">4.0 Working Experience</div>
            @foreach($experience as $item)
                <div class="block-item">
                    @if(!empty($item['period']))
                        <div><strong>{{ $item['period'] }}</strong></div>
                    @endif
                    @if(!empty($item['title']))
                        <div>{{ $item['title'] }}</div>
                    @endif
                    @if(!empty($item['organization']))
                        <div>{{ $item['organization'] }}</div>
                    @endif
                    @if(!empty($item['description']))
                        <div style="margin-top: 4px;">{{ $item['description'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($skills))
        <div class="section">
            <div class="section-title">5.0 Ability / Skills</div>
            <ol class="list">
                @foreach($skills as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    @if(!empty($additionalSkills))
        <div class="section">
            <div class="section-title">6.0 Extra Knowledge</div>
            <ol class="list">
                @foreach($additionalSkills as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    @if(!empty($languages))
        <div class="section">
            <div class="section-title">7.0 Language Skills</div>
            <table class="grid-table">
                <thead>
                    <tr>
                        <th>Language</th>
                        <th>Reading</th>
                        <th>Writing</th>
                        <th>Speaking</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($languages as $item)
                        <tr>
                            <td>{{ $item['language'] ?? '' }}</td>
                            <td>{{ $item['reading'] ?? '' }}</td>
                            <td>{{ $item['writing'] ?? '' }}</td>
                            <td>{{ $item['speaking'] ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if(!empty($interests))
        <div class="section">
            <div class="section-title">8.0 Interest and Hobbies</div>
            <ol class="list">
                @foreach($interests as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    @if(!empty($referees))
        <div class="section">
            <div class="section-title">9.0 Referees</div>
            @foreach($referees as $item)
                <div class="block-item">
                    @if(!empty($item['name']))
                        <div><strong>Name:</strong> {{ $item['name'] }}</div>
                    @endif
                    @if(!empty($item['title']))
                        <div><strong>Title:</strong> {{ $item['title'] }}</div>
                    @endif
                    @if(!empty($item['organization']))
                        <div><strong>Organization:</strong> {{ $item['organization'] }}</div>
                    @endif
                    @if(!empty($item['address']))
                        <div><strong>Address:</strong> {{ $item['address'] }}</div>
                    @endif
                    @if(!empty($item['mobile']))
                        <div><strong>Mobile:</strong> {{ $item['mobile'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($declaration))
        <div class="section">
            <div class="section-title">10.0 Declaration</div>
            <div>{{ $declaration }}</div>
        </div>
    @endif

    <div class="signature-wrap">
        <div><strong>Signature:</strong></div>
        @if(!empty($signatureDataUrl))
            <div style="margin-top: 8px;">
                <img src="{{ $signatureDataUrl }}" alt="Signature" class="signature-image">
            </div>
        @else
            <div class="signature-line"></div>
        @endif

        @if(!empty($signatureDate))
            <div class="date-wrap"><strong>Date:</strong> {{ $signatureDate }}</div>
        @endif
    </div>
</body>
</html>