document.addEventListener('DOMContentLoaded', () => {
    const markInputs = document.querySelectorAll('.mark-input');
    const liveTotal = document.getElementById('liveTotal');
    const livePercentage = document.getElementById('livePercentage');
    const liveGrade = document.getElementById('liveGrade');

    const hiddenTotal = document.getElementById('hiddenTotal');
    const hiddenPercentage = document.getElementById('hiddenPercentage');
    const hiddenGrade = document.getElementById('hiddenGrade');
    
    const liveSGPA = document.getElementById('liveSGPA');
    const liveCGPA = document.getElementById('liveCGPA');
    const hiddenSGPA = document.getElementById('hiddenSGPA');
    const hiddenCGPA = document.getElementById('hiddenCGPA');
    const prevCgpaInput = document.getElementById('prevCgpa');

    function getGradePoint(marks) {
        if (marks >= 90) return 10;
        if (marks >= 80) return 9;
        if (marks >= 70) return 8;
        if (marks >= 60) return 7;
        if (marks >= 50) return 6;
        return 0;
    }

    function calculateResult() {
        let total = 0;
        let totalGradePoints = 0;
        let subjectsCount = markInputs.length;
        let validInputs = 0;

        markInputs.forEach(input => {
            const value = parseFloat(input.value);
            if (!isNaN(value) && value >= 0 && value <= 100) {
                total += value;
                totalGradePoints += getGradePoint(value);
                validInputs++;
            }
        });

        if (validInputs === subjectsCount) {
            const percentage = (total / (subjectsCount * 100)) * 100;

            let grade = 'F';
            if (percentage >= 90) grade = 'A+';
            else if (percentage >= 80) grade = 'A';
            else if (percentage >= 70) grade = 'B';
            else if (percentage >= 60) grade = 'C';
            else if (percentage >= 50) grade = 'D';

            const sgpa = totalGradePoints / subjectsCount;
            let cgpa = sgpa;
            if (prevCgpaInput && prevCgpaInput.value) {
                const prev = parseFloat(prevCgpaInput.value);
                if (!isNaN(prev) && prev >= 0 && prev <= 10) {
                    cgpa = (prev + sgpa) / 2;
                }
            }

            // Update UI
            liveTotal.textContent = `${total} / ${subjectsCount * 100}`;
            livePercentage.textContent = `${percentage.toFixed(2)}%`;
            liveGrade.textContent = grade;
            liveSGPA.textContent = sgpa.toFixed(2);
            liveCGPA.textContent = cgpa.toFixed(2);

            // Update Hidden fields for PHP
            hiddenTotal.value = total;
            hiddenPercentage.value = percentage.toFixed(2);
            hiddenGrade.value = grade;
            hiddenSGPA.value = sgpa.toFixed(2);
            hiddenCGPA.value = cgpa.toFixed(2);

            // Add cool styling classes based on grade
            liveGrade.className = 'stat-value grade-' + grade.replace('+', 'plus').toLowerCase();
        } else {
            liveTotal.textContent = '0 / 500';
            livePercentage.textContent = '0%';
            liveGrade.textContent = '-';
            liveSGPA.textContent = '0.00';
            liveCGPA.textContent = '0.00';
            liveGrade.className = 'stat-value';
        }
    }

    markInputs.forEach(input => {
        input.addEventListener('input', calculateResult);
    });

    if (prevCgpaInput) {
        prevCgpaInput.addEventListener('input', calculateResult);
    }
});
