@extends('instructor.inc.layout')

@section('content')

<section class="admin-dashboard-section py-5">
    <div class="container">
        <!-- Form để tạo mới Quiz -->
        <div class="mb-5">
            <h3>Create New Quiz</h3>
            <form action="{{ route('instructor.curriculums.quiz.store') }}" method="POST">
                @csrf
                <input type="hidden" name="QuizID" value="{{ $curriculums[0]->QuizID }}">

                <div class="form-group mb-3">
                    <label for="Question">Question</label>
                    <textarea class="form-control" id="Question" name="Question" rows="3" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="Choices">Choices</label>
                    <div id="choices-container">
                        <div class="choice-item mb-2">
                            <input type="text" class="form-control mb-1" name="Choices[0][Answer]" placeholder="Answer" required>
                            <textarea class="form-control mb-1" name="Choices[0][Explanation]" rows="2" placeholder="Explanation" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addChoice()">Add Another Choice</button>
                </div>

                <div class="form-group mb-3">
                    <label for="CorrectAnswer">Correct Answer</label>
                    <input type="text" class="form-control" id="CorrectAnswer" name="CorrectAnswer" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Question</button>
            </form>
        </div>

        <!-- Danh sách các câu hỏi -->
        <div class="question-list">
            <h3>Questions</h3>
            <ul class="list-group">
                @foreach ($curriculums as $curriculum)
                @if ($curriculum->MCQNo !== null)
                    @php
                        $choices = json_decode($curriculum->Choices, true);
                    @endphp
                    <li class="list-group-item border border-secondary rounded mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-1">{{ $curriculum->Question }}</h5>
                            <a href="{{ route('instructor.curriculums.quiz.question.edit', $curriculum->MCQNo) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                        <ul class="list-unstyled mt-2">
                            @foreach ($choices as $choice)
                                <li>
                                    <strong>{{ $choice['Answer'] }}:</strong> {{ $choice['Explanation'] }}
                                </li>
                            @endforeach
                        </ul>
                        <p class="mb-0"><strong>Correct Answer:</strong> {{ $curriculum->CorrectAnswer }}</p>
                    </li>
                @endif
            @endforeach


            </ul>
        </div>
    </div>

    @include('instructor.inc.sidebar')
</section>

<script>
    let choiceIndex = 1;

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
