<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Records')</title>

    {{-- Google Font: Roboto --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* ---------- Color theme ---------- */
        :root {
            --color-primary: #ffffff;   /* white - cards / containers */
            --color-secondary: #2563eb; /* blue - main buttons / links */
            --color-tertiary: #dc2626;  /* red - delete / errors */
            --color-page: #f3f4f6;      /* soft gray page background */
            --color-text: #1f2937;
            --color-border: #e5e7eb;
            --radius: 12px;             /* rounded corners */
        }

        /* ---------- Base page ---------- */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 32px 20px;
            font-family: 'Roboto', Arial, sans-serif;
            background: var(--color-page);
            color: var(--color-text);
        }

        .page {
            max-width: 960px;
            margin: 0 auto;
        }

        /* ---------- Alerts (shown BELOW the main card) ---------- */
        .alert {
            border-radius: var(--radius);
            padding: 12px 16px;
            margin-top: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #6ee7b7;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: var(--color-tertiary);
        }

        .alert-error ul {
            margin: 0;
            padding-left: 18px;
        }

        /* ---------- White card container ---------- */
        .card {
            background: var(--color-primary);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--color-border);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--color-secondary);
        }

        .page-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-secondary);
        }

        /* ---------- Buttons ---------- */
        .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: var(--radius);
            border: none;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
        }

        .btn-blue {
            background: var(--color-secondary);
            color: #ffffff;
        }

        .btn-blue:hover {
            background: #1d4ed8;
        }

        .btn-red {
            background: var(--color-tertiary);
            color: #ffffff;
        }

        .btn-red:hover {
            background: #b91c1c;
        }

        .btn-green {
            background: #16a34a;
            color: #ffffff;
        }

        .btn-green:hover {
            background: #15803d;
        }

        .btn-outline {
            background: var(--color-primary);
            color: var(--color-secondary);
            border: 1px solid var(--color-secondary);
        }

        /* Smaller buttons for table actions */
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85rem;
            border-radius: 8px;
        }

        /* ---------- List table ---------- */
        .table-wrap {
            max-height: 70vh; /* scroll inside this box */
            overflow: auto;
            border-radius: var(--radius);
            border: 1px solid var(--color-border);
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            background: var(--color-primary);
        }

        table.data th,
        table.data td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid var(--color-border);
            vertical-align: middle;
        }

        table.data th {
            background: #eff6ff;
            color: var(--color-secondary);
            font-weight: 700;
            position: sticky; /* keep header visible while scrolling */
            top: 0;
            z-index: 2;
        }

        table.data tr:last-child td {
            border-bottom: none;
        }

        table.data tbody tr:hover {
            background: #f9fafb;
        }

        .actions-cell {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .student-detail-layout {
            display: grid;
            grid-template-columns: minmax(180px, 240px) minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }

        .student-photo-panel {
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: stretch;
            border: 2px solid var(--color-secondary);
            border-radius: var(--radius);
            padding: 12px;
            text-align: center;
        }

        .student-photo,
        .student-photo-placeholder {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 8px;
        }

        .student-photo {
            display: block;
            object-fit: cover;
        }

        .student-photo-placeholder {
            display: grid;
            place-items: center;
            padding: 16px;
            background: #eff6ff;
            color: #64748b;
            font-size: 0.9rem;
        }

        .form-photo-preview {
            display: block;
            width: 120px;
            height: 120px;
            margin-bottom: 12px;
            border-radius: 8px;
            object-fit: cover;
        }

        .inline-delete {
            display: inline;
            margin: 0;
        }

        @media (max-width: 700px) {
            .student-detail-layout {
                grid-template-columns: 1fr;
            }

            .student-photo-panel {
                max-width: 280px;
                margin: 0 auto;
                width: 100%;
            }
        }

        /* ---------- Detail / form table ---------- */
        table.detail {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid var(--color-border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        table.detail th,
        table.detail td {
            padding: 12px 14px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid var(--color-border);
        }

        table.detail tr:last-child th,
        table.detail tr:last-child td {
            border-bottom: none;
        }

        table.detail th {
            width: 160px;
            background: #eff6ff;
            color: var(--color-secondary);
            font-weight: 700;
        }

        table.detail input[type="text"],
        table.detail input[type="number"],
        table.detail input[type="date"],
        table.detail select,
        table.detail textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            background: #ffffff;
        }

        table.detail input:focus,
        table.detail select:focus,
        table.detail textarea:focus {
            outline: 2px solid #93c5fd;
            border-color: var(--color-secondary);
        }

        table.detail small {
            display: block;
            margin-top: 6px;
            color: #6b7280;
        }

        .subject-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            background: #dcfce7; /* light green */
            color: #166534;      /* darker green text */
            border: 1px solid #16a34a; /* darker green border */
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Individual subject inputs on create/edit */
        .subjects-box {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .subject-row {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .subject-row input {
            flex: 1;
        }

        .actions-row {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            align-items: center;
        }

        /* ---------- Custom delete confirmation dialog ---------- */
        .dialog-overlay {
            display: none; /* hidden by default */
            position: fixed;
            inset: 0;
            background: rgba(17, 24, 39, 0.45);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .dialog-overlay.is-open {
            display: flex;
        }

        .dialog-box {
            background: var(--color-primary);
            border-radius: var(--radius);
            border: 1px solid var(--color-border);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
            padding: 24px;
        }

        .dialog-box h2 {
            margin: 0 0 8px;
            font-size: 1.25rem;
            color: var(--color-secondary);
        }

        .dialog-box p {
            margin: 0 0 20px;
            color: var(--color-text);
            line-height: 1.5;
        }

        .dialog-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="page">
        {{-- Main page content (card / form) --}}
        @yield('content')

        {{-- Action notifications appear BELOW the main container --}}
        @if (session('success'))
            <div id="flash-success" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div id="flash-error" class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Custom delete confirmation (theme-matched, not browser alert) --}}
    <div id="delete-dialog" class="dialog-overlay" aria-hidden="true">
        <div class="dialog-box" role="dialog" aria-modal="true" aria-labelledby="delete-dialog-title">
            <h2 id="delete-dialog-title">Delete student?</h2>
            <p id="delete-dialog-message">Are you sure you want to delete the record?</p>
            <div class="dialog-actions">
                <button type="button" id="delete-cancel-btn" class="btn btn-outline">Cancel</button>
                <button type="button" id="delete-confirm-btn" class="btn btn-red">Yes, delete</button>
            </div>
        </div>
    </div>

    <script>
        // Wait 3000 milliseconds (3 seconds), then remove the alert from the page
        function hideAlertAfterThreeSeconds(elementId) {
            var alertBox = document.getElementById(elementId);

            if (alertBox) {
                setTimeout(function () {
                    alertBox.remove();
                }, 3000);
            }
        }

        hideAlertAfterThreeSeconds('flash-success');
        hideAlertAfterThreeSeconds('flash-error');

        // ----- Custom delete dialog -----
        var deleteDialog = document.getElementById('delete-dialog');
        var deleteMessage = document.getElementById('delete-dialog-message');
        var deleteCancelBtn = document.getElementById('delete-cancel-btn');
        var deleteConfirmBtn = document.getElementById('delete-confirm-btn');
        var formToDelete = null; // remembers which delete form to submit

        function openDeleteDialog(form, studentName) {
            formToDelete = form;

            if (studentName) {
                deleteMessage.textContent = 'Are you sure you want to delete the record for ' + studentName + '?';
            } else {
                deleteMessage.textContent = 'Are you sure you want to delete the record?';
            }

            deleteDialog.classList.add('is-open');
            deleteDialog.setAttribute('aria-hidden', 'false');
        }

        function closeDeleteDialog() {
            formToDelete = null;
            deleteDialog.classList.remove('is-open');
            deleteDialog.setAttribute('aria-hidden', 'true');
        }

        // Open dialog when a Delete button is clicked
        document.querySelectorAll('.btn-delete-open').forEach(function (button) {
            button.addEventListener('click', function () {
                var form = button.closest('form');
                var studentName = button.getAttribute('data-student-name') || '';
                openDeleteDialog(form, studentName);
            });
        });

        // Cancel closes the dialog (does not delete)
        deleteCancelBtn.addEventListener('click', function () {
            closeDeleteDialog();
        });

        // Clicking the dark background also cancels
        deleteDialog.addEventListener('click', function (event) {
            if (event.target === deleteDialog) {
                closeDeleteDialog();
            }
        });

        // Yes submits the remembered delete form
        deleteConfirmBtn.addEventListener('click', function () {
            if (formToDelete) {
                formToDelete.submit();
            }
        });

        // ----- Subjects: add / remove individual inputs -----
        var subjectsList = document.getElementById('subjects-list');
        var addSubjectBtn = document.getElementById('add-subject-btn');

        function createSubjectRow(value) {
            var row = document.createElement('div');
            row.className = 'subject-row';

            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'subjects[]';
            input.maxLength = 100;
            input.placeholder = 'Subject name';
            input.value = value || '';

            var removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn btn-red btn-sm remove-subject-btn';
            removeBtn.textContent = 'Remove';

            row.appendChild(input);
            row.appendChild(removeBtn);
            return row;
        }

        function removeSubjectRow(row) {
            if (!subjectsList || !row) {
                return;
            }

            if (subjectsList.querySelectorAll('.subject-row').length > 1) {
                row.remove();
            } else {
                var input = row.querySelector('input');
                if (input) {
                    input.value = '';
                }
            }
        }

        if (subjectsList) {
            subjectsList.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove-subject-btn')) {
                    removeSubjectRow(event.target.closest('.subject-row'));
                }
            });
        }

        if (addSubjectBtn && subjectsList) {
            addSubjectBtn.addEventListener('click', function () {
                subjectsList.appendChild(createSubjectRow(''));
            });
        }
    </script>
</body>
</html>
