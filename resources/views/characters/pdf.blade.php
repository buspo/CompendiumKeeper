<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character Sheet - {{ $data['charname'] ?? 'Unnamed' }}</title>
    <style>
        /* Reset & page settings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', 'Helvetica', sans-serif;
            font-size: 9.5pt;
            line-height: 1.35;
            color: #1f3550;
            background: #edf4ff;
            margin: 0;
            padding: 0.5cm;
        }
        @page {
            size: A4 portrait;
            margin: 0.8cm;
        }
        .sheet {
            max-width: 100%;
            margin: 0 auto;
            background: #f8fbff;
            border: 2px solid #0056b3;
            padding: 10px;
        }
        .banner {
            border: 1px solid #0056b3;
            background: #dcecff;
            padding: 6px 10px;
            margin-bottom: 10px;
        }
        .banner h1 {
            font-family: 'DejaVu Serif', 'Times New Roman', serif;
            font-size: 15pt;
            margin: 0;
            color: #003366;
            letter-spacing: 0.4px;
        }
        .banner p {
            margin: 3px 0 0;
            font-size: 9pt;
            color: #0d47a1;
        }
        h2 {
            font-family: 'DejaVu Serif', 'Times New Roman', serif;
            font-size: 11pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #ffffff;
            background: #0056b3;
            border: 1px solid #003366;
            padding: 5px 8px;
            margin: 10px 0 6px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }
        th, td {
            border: 1px solid #a7c4e7;
            padding: 4px 6px;
            vertical-align: top;
            text-align: left;
        }
        th {
            background-color: #dcecff;
            color: #003366;
            font-weight: bold;
        }
        td {
            background: #ffffff;
        }
        tbody tr:nth-child(even) td {
            background: #f2f8ff;
        }
        .character-header td {
            background: transparent;
        }
        .stat-block {
            display: inline-block;
            width: 100px;
            margin: 5px;
            text-align: center;
        }
        .stat-label {
            font-weight: bold;
            font-size: 9pt;
            color: #0d47a1;
        }
        .stat-value {
            font-size: 14pt;
            font-weight: bold;
            color: #003366;
        }
        .compact-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 3px;
            table-layout: fixed;
            margin-bottom: 8px;
        }
        .compact-grid td {
            border: 1px solid #b8d1f0;
            background: #ffffff;
            width: 33.33%;
            padding: 3px 4px;
            font-size: 9pt;
            line-height: 1.2;
            vertical-align: top;
        }
        .text-block {
            border: 1px solid #b8d1f0;
            background: #ffffff;
            padding: 6px 8px;
            margin-bottom: 8px;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .spell-table {
            table-layout: fixed;
            font-size: 8pt;
        }
        .spell-table th,
        .spell-table td {
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .spell-prep {
            text-align: center;
            font-size: 10pt;
            font-weight: bold;
        }
        hr {
            margin: 15px 0;
            border: none;
            border-top: 1px solid #b8d1f0;
        }
        .footer {
            font-size: 8pt;
            text-align: center;
            color: #355a87;
            margin-top: 14px;
            border-top: 1px solid #b8d1f0;
            padding-top: 5px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
<div class="sheet">
    <div class="banner">
        <h1>D&D Character Sheet</h1>
        <p>
            {{ $data['charname'] ?? 'Unnamed' }}
            @if(!empty($data['classlevel'] ?? '')) - {{ $data['classlevel'] }} @endif
            @if(!empty($data['race'] ?? '')) - {{ $data['race'] }} @endif
        </p>
    </div>

    @php
        $renderText = static function (?string $value): string {
            $text = (string) ($value ?? '');

            $text = preg_replace_callback('/https?:\/\/\S+|www\.\S+/i', static function (array $matches): string {
                return preg_replace('/([\/\.\?\#\=\:\-_&])/', '$1__ZWSP__', $matches[0]);
            }, $text);

            $escaped = e($text);

            return nl2br(str_replace('__ZWSP__', '&#8203;', $escaped));
        };
    @endphp

    {{-- Character header --}}
    <table class="character-header" style="margin-bottom: 15px;">
        <tr>
            <td style="border: none; width: 30%;"><strong>Character Name</strong><br>{{ $data['charname'] ?? '' }}</td>
            <td style="border: none; width: 20%;"><strong>Class & Level</strong><br>{{ $data['classlevel'] ?? '' }}</td>
            <td style="border: none; width: 20%;"><strong>Background</strong><br>{{ $data['background'] ?? '' }}</td>
            <td style="border: none; width: 30%;"><strong>Player Name</strong><br>{{ $data['playername'] ?? '' }}</td>
        </tr>
        <tr>
            <td style="border: none;"><strong>Race</strong><br>{{ $data['race'] ?? '' }}</td>
            <td style="border: none;"><strong>Alignment</strong><br>{{ $data['alignment'] ?? '' }}</td>
            <td style="border: none;"><strong>Experience Points</strong><br>{{ $data['experiencepoints'] ?? '0' }}</td>
            <td style="border: none;"></td>
        </tr>
    </table>

    {{-- Ability scores & modifiers --}}
    <h2>Ability Scores</h2>
    <table>
        <tr>
            @foreach(['Strength','Dexterity','Constitution','Intelligence','Wisdom','Charisma'] as $ability)
                <th>{{ $ability }}</th>
            @endforeach
        </tr>
        <tr>
            @foreach(['Strength','Dexterity','Constitution','Intelligence','Wisdom','Charisma'] as $ability)
                <td style="text-align: center;">
                    <div class="stat-value">{{ $data[$ability.'score'] ?? '10' }}</div>
                    <div class="stat-label">Mod: {{ $data[$ability.'mod'] ?? '+0' }}</div>
                </td>
            @endforeach
        </tr>
    </table>

    {{-- Saving Throws --}}
    <h2>Saving Throws</h2>
    @php
        $savingThrows = ['Strength', 'Dexterity', 'Constitution', 'Intelligence', 'Wisdom', 'Charisma'];
    @endphp
    <table class="compact-grid">
        @foreach(array_chunk($savingThrows, 3) as $saveRow)
            <tr>
                @foreach($saveRow as $ability)
                    <td>
                        <strong>{{ $ability }}</strong>: {{ $data[$ability.'-save'] ?? '0' }}
                        @if(($data[$ability.'-save-prof'] ?? '') === 'checked') ✓ @endif
                    </td>
                @endforeach
                @for($i = count($saveRow); $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
        @endforeach
    </table>

    {{-- Skills --}}
    <h2>Skills</h2>
    @php
        $skills = [
            'Acrobatics' => 'Dex', 'Animal Handling' => 'Wis', 'Arcana' => 'Int',
            'Athletics' => 'Str', 'Deception' => 'Cha', 'History' => 'Int',
            'Insight' => 'Wis', 'Intimidation' => 'Cha', 'Investigation' => 'Int',
            'Medicine' => 'Wis', 'Nature' => 'Int', 'Perception' => 'Wis',
            'Performance' => 'Cha', 'Persuasion' => 'Cha', 'Religion' => 'Int',
            'Sleight of Hand' => 'Dex', 'Stealth' => 'Dex', 'Survival' => 'Wis'
        ];
    @endphp
    <table class="compact-grid">
        @foreach(array_chunk($skills, 3, true) as $skillsRow)
            <tr>
                @foreach($skillsRow as $skill => $attr)
                    <td>
                        <strong>{{ $skill }} ({{ $attr }})</strong>: {{ $data[$skill] ?? '0' }}
                        @if(($data[$skill.'-prof'] ?? '') === 'checked') ✓ @endif
                    </td>
                @endforeach
                @for($i = count($skillsRow); $i < 3; $i++)
                    <td></td>
                @endfor
            </tr>
        @endforeach
    </table>

    {{-- Combat stats --}}
    <h2>Combat</h2>
    <table>
        <tr><th>Armor Class</th><td>{{ $data['ac'] ?? '' }}</td>
            <th>Initiative</th><td>{{ $data['initiative'] ?? '' }}</td>
            <th>Speed</th><td>{{ $data['speed'] ?? '' }}</td></tr>
        <tr><th>Current HP</th><td>{{ $data['currenthp'] ?? '' }}</td>
            <th>Max HP</th><td>{{ $data['maxhp'] ?? '' }}</td>
            <th>Temporary HP</th><td>{{ $data['temphp'] ?? '' }}</td></tr>
        <tr><th>Hit Dice</th><td colspan="2">{{ $data['totalhd'] ?? '' }} (remaining: {{ $data['remaininghd'] ?? '' }})</td>
            <th>Death Saves</th><td colspan="2">
                Successes: @for($i=1;$i<=3;$i++) @if(($data['deathsuccess'.$i] ?? '') === 'checked') ✓ @else ☐ @endif @endfor
                Failures: @for($i=1;$i<=3;$i++) @if(($data['deathfail'.$i] ?? '') === 'checked') ✗ @else ☐ @endif @endfor
            </td></tr>
    </table>

    {{-- Attacks --}}
    <h2>Attacks & Spellcasting</h2>
    <table>
        <thead><tr><th>Name</th><th>Attack Bonus</th><th>Damage/Type</th><th>Notes</th></tr></thead>
        <tbody>
            @php $rowsAttacks = (int)($data['rows_attacks'] ?? 0); @endphp
            @for($i = 0; $i < max($rowsAttacks, 2); $i++)
                <tr>
                    <td>{{ $data['atkname'.$i] ?? '' }}</td>
                    <td>{{ $data['atkbonus'.$i] ?? '' }}</td>
                    <td>{{ $data['atkdamage'.$i] ?? '' }}</td>
                    <td>{{ $data['atknotes'.$i] ?? '' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
    <div class="text-block"><strong>Notes:</strong><br>{!! $renderText($data['attacksnotes'] ?? '') !!}</div>

    {{-- Spell Slots --}}
    <h2>Spell Slots</h2>
    <table>
        <tr><th>Level</th>@for($i=1;$i<=9;$i++)<th>{{ $i }}</th>@endfor</tr>
        <tr>
            <td>Available</td>
            @for($i=1;$i<=9;$i++)<td>{{ $data['spellslots'.$i] ?? '' }}</td>@endfor
        </tr>
        <tr>
            <td>Maximum</td>
            @for($i=1;$i<=9;$i++)<td>{{ $data['spellslotsmax'.$i] ?? '' }}</td>@endfor
        </tr>
    </table>

    {{-- Spell List --}}
    <h2>Spells</h2>
    <table class="spell-table">
        <thead>
            <tr>
                <th style="width: 8%;">Prep</th>
                <th style="width: 27%;">Spell</th>
                <th style="width: 30%;">Casting</th>
                <th style="width: 35%;">Details</th>
            </tr>
        </thead>
        <tbody>
            @php $rowsSpells = (int)($data['rows_spells'] ?? 0); @endphp
            @for($i = 0; $i < max($rowsSpells, 2); $i++)
                <tr>
                    <td class="spell-prep">@if(($data['spellprep'.$i] ?? '') === 'checked') ✓ @endif</td>
                    <td>
                        <strong>{{ $data['spellname'.$i] ?? '' }}</strong><br>
                        <strong>Level:</strong> {{ $data['spelllevel'.$i] ?? '' }}<br>
                        <strong>Source:</strong> {{ $data['spellsource'.$i] ?? '' }}
                    </td>
                    <td>
                        <strong>Cast Time:</strong> {{ $data['spelltime'.$i] ?? '' }}<br>
                        <strong>Attack/Save:</strong> {{ $data['spellattacksave'.$i] ?? '' }}<br>
                        <strong>Range:</strong> {{ $data['spellrange'.$i] ?? '' }}
                    </td>
                    <td>
                        <strong>Duration:</strong> {{ $data['spellduration'.$i] ?? '' }}<br>
                        <strong>Components:</strong> {{ $data['spellcomponents'.$i] ?? '' }}<br>
                        <strong>Notes:</strong> {!! $renderText($data['spellnotes'.$i] ?? '') !!}
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
    <div class="text-block"><strong>Additional spell notes:</strong><br>{!! $renderText($data['spellsnotes'] ?? '') !!}</div>

    {{-- Inventory, Currency, Attunement --}}
    <h2>Inventory</h2>
    <table>
        <thead><tr><th>Equipped</th><th>Name</th><th>Count</th><th>Weight</th><th>Value</th><th>Notes</th></tr></thead>
        <tbody>
            @php $rowsInventory = (int)($data['rows_inventory'] ?? 0); @endphp
            @for($i = 0; $i < max($rowsInventory, 2); $i++)
                <tr>
                    <td>@if(($data['itemequipped'.$i] ?? '') === 'checked') ✓ @endif</td>
                    <td>{{ $data['itemname'.$i] ?? '' }}</td>
                    <td>{{ $data['itemcount'.$i] ?? '' }}</td>
                    <td>{{ $data['itemweight'.$i] ?? '' }}</td>
                    <td>{{ $data['itemvalue'.$i] ?? '' }}</td>
                    <td>{{ $data['itemnotes'.$i] ?? '' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>
    <div class="text-block"><strong>Inventory notes:</strong><br>{!! $renderText($data['inventorynotes'] ?? '') !!}</div>

    <h2>Currency</h2>
    <table style="width: auto;">
        <tr>
            <th>pp</th><td>{{ $data['pp'] ?? '0' }}</td>
            <th>gp</th><td>{{ $data['gp'] ?? '0' }}</td>
            <th>ep</th><td>{{ $data['ep'] ?? '0' }}</td>
            <th>sp</th><td>{{ $data['sp'] ?? '0' }}</td>
            <th>cp</th><td>{{ $data['cp'] ?? '0' }}</td>
        </tr>
    </table>

    <h2>Features, Traits & Feats</h2>
    @php
        $featuresText = trim(
            ($data['features-l'] ?? '') . "\n\n" .
            ($data['features-c'] ?? '') . "\n\n" .
            ($data['features-r'] ?? '')
        );
    @endphp
    <div class="text-block">{!! $renderText($featuresText) !!}</div>

    <h2>Other Proficiencies and Languages</h2>
    <div class="text-block">{!! $renderText($data['otherprofs'] ?? '') !!}</div>

    <h2>Description</h2>
    <table>
        <tr><th>Gender</th><td>{{ $data['gender'] ?? '' }}</td><th>Age</th><td>{{ $data['age'] ?? '' }}</td></tr>
        <tr><th>Height</th><td>{{ $data['height'] ?? '' }}</td><th>Weight</th><td>{{ $data['weight'] ?? '' }}</td></tr>
        <tr><th>Faith</th><td>{{ $data['faith'] ?? '' }}</td><th>Skin</th><td>{{ $data['skin'] ?? '' }}</td></tr>
        <tr><th>Eyes</th><td>{{ $data['eyes'] ?? '' }}</td><th>Hair</th><td>{{ $data['hair'] ?? '' }}</td></tr>
    </table>

    <h2>Backstory & Allies</h2>
    <div class="text-block"><strong>Allies, Organizations, Enemies:</strong><br>{!! $renderText($data['organizations'] ?? '') !!}</div>
    <div class="text-block"><strong>Character Backstory:</strong><br>{!! $renderText($data['backstory'] ?? '') !!}</div>
    <div class="text-block"><strong>Personality Traits:</strong><br>{!! $renderText($data['personality'] ?? '') !!}</div>
    <div class="text-block"><strong>Ideals:</strong><br>{!! $renderText($data['ideals'] ?? '') !!}</div>
    <div class="text-block"><strong>Bonds:</strong><br>{!! $renderText($data['bonds'] ?? '') !!}</div>
    <div class="text-block"><strong>Flaws:</strong><br>{!! $renderText($data['flaws'] ?? '') !!}</div>

    <h2>Additional Notes</h2>
    @php
        $additionalNotes = trim(
            ($data['notes-l'] ?? '') . "\n\n" .
            ($data['notes-c'] ?? '') . "\n\n" .
            ($data['notes-r'] ?? '')
        );
    @endphp
    <div class="text-block">{!! $renderText($additionalNotes) !!}</div>

    <div class="footer">
        Character sheet generated from CompendiumKeeper.
    </div>
</div>
</body>
</html>