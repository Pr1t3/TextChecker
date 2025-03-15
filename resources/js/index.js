document.addEventListener('DOMContentLoaded', function () {
    const userText = document.getElementById('userText');
    const hiddenTextarea = document.getElementById('hiddenTextarea');
    const hasUserText = userText.getAttribute('data-has-user-text') === 'true';
    let isDone = hasUserText && userText.querySelector('strong') === null;
    let previousValue = userText.innerText;
    
    async function handleChange() {
        const currentValue = userText.innerText;
        if (currentValue !== previousValue) {
            previousValue = currentValue;
            if (!isDone && hasUserText && userText.querySelector('strong') === null) {
                await new Promise(resolve => setTimeout(submitForm, 1000));                  
            }
        }
    }
    
    userText.addEventListener('input', handleChange);
    userText.addEventListener('blur', handleChange);
    
    function syncTextarea() {
        isDone = false;
        hiddenTextarea.value = userText.innerText;
    }
    
    function submitForm() {
        hiddenTextarea.value = userText.innerText;
    
        fetch('/check-text', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ userText: hiddenTextarea.value }),
        })
        .then(response => response.json())
        .then(data => {
            userText.innerHTML = `${ data }`;
            hiddenTextarea.value = userText.innerText;
            if (userText.querySelector('strong') === null) {
                isDone = true;
            }  
        })
        .catch(error => {
            console.error('Ошибка при автоматической проверки текста:', error);
        });
    }
    
    document.getElementById('checkForm').addEventListener('submit', function (e) {
        e.preventDefault();
        syncTextarea();
        this.submit();
    });
});