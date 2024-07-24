@extends('instructor.inc.layout')

@section('content')

<section class="admin-dashboard-section py-5">
    <div class="container">
        <!-- Form để chỉnh sửa câu hỏi -->
        <div class="mb-5">
            <h3>Edit Question</h3>
            <form action="{{ route('instructor.curriculums.quiz.update', $question->MCQNo) }}" method="POST">
                @csrf
                @method('PUT') <!-- Đặt phương thức PUT cho cập nhật -->

                <div class="form-group mb-3">
                    <label for="Question">Question</label>
                    <textarea class="form-control" id="Question" name="Question" rows="3" required>{{ $question->Question }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="Choices">Choices</label>
                    <div id="choices-container">
                        @php
                            $choices = json_decode($question->Choices, true);
                        @endphp
                        @foreach ($choices as $index => $choice)
                            <div class="choice-item mb-2">
                                <input type="text" class="form-control mb-1" name="Choices[{{ $index }}][Answer]" value="{{ $choice['Answer'] }}" placeholder="Answer" required>
                                <textarea class="form-control mb-1" name="Choices[{{ $index }}][Explanation]" rows="2" placeholder="Explanation" required>{{ $choice['Explanation'] }}</textarea>
                            </div>
                        @endforeach
                        <button type="button" class="btn btn-secondary" onclick="addChoice()">Add Another Choice</button>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="CorrectAnswer">Correct Answer</label>
                    <input type="text" class="form-control" id="CorrectAnswer" name="CorrectAnswer" value="{{ $question->CorrectAnswer }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Question</button>
            </form>
        </div>
    </div>
</section>

<script>
    let choiceIndex = {{ count($choices) }};

    function addChoice() {
        const container = document.getElementById('choices-container');
        const newChoice = document.createElement('div');
        newChoice.classList.add('choice-item', 'mb-2');
        newChoice.innerHTML = `
            <input type="text" class="form-control mb-1" name="Choices[${choiceIndex}][Answer]" placeholder="Answer" required>
            <textarea class="form-control mb-1" name="Choices[${choiceIndex}][Explanation]" rows="2" placeholder="Explanation" required></textarea>
        `;
        container.appendChild(newChoice);
        choiceIndex++;
    }
</script>

@endsection
