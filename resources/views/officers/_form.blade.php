<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Officer Form </title>
</head>
<body>
    <div class="form-section">Personal information</div>
<div class="form-grid">
    <div class="field full">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name"
               value="{{ old('name', $officer->name ?? '') }}" placeholder="e.g. Sinoun" required autofocus>
        @error('name')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
            <option value="">Select gender</option>
            <option value="male" {{ old('gender', $officer->gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $officer->gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
        </select>
        @error('gender')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field">
        <label for="dob">Date of Birth</label>
        <input type="date" id="dob" name="dob"
               value="{{ old('dob', isset($officer) ? $officer->dob?->format('Y-m-d') : '') }}">
        @error('dob')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone"
               value="{{ old('phone', $officer->phone ?? '') }}" placeholder="e.g. 012 345 678">
        @error('phone')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="{{ old('email', $officer->email ?? '') }}" placeholder="e.g. name@email.com">
        @error('email')<span class="error">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-section">Job information</div>
<div class="form-grid">
    <div class="field">
        <label for="position">Position</label>
        <input type="text" id="position" name="position"
               value="{{ old('position', $officer->position ?? '') }}" placeholder="e.g. Senior Developer" required>
        @error('position')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field">
        <label for="dept_id">Department</label>
        <select id="dept_id" name="dept_id" required>
            <option value="">Select department</option>
            @foreach ($departments as $dept)
                <option value="{{ $dept->dept_id }}"
                    {{ old('dept_id', $officer->dept_id ?? '') == $dept->dept_id ? 'selected' : '' }}>
                    {{ $dept->name }}
                </option>
            @endforeach
        </select>
        @error('dept_id')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field">
        <label for="hire_date">Hire Date</label>
        <input type="date" id="hire_date" name="hire_date"
               value="{{ old('hire_date', isset($officer) ? $officer->hire_date?->format('Y-m-d') : '') }}">
        @error('hire_date')<span class="error">{{ $message }}</span>@enderror
    </div>

    <div class="field full">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Optional notes...">{{ old('description', $officer->description ?? '') }}</textarea>
        @error('description')<span class="error">{{ $message }}</span>@enderror
    </div>
</div>
</body>
</html>