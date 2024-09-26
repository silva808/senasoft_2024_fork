// Get all buttons and content sections
const buttons = document.querySelectorAll('.options');
const sections = document.querySelectorAll('.cont-main');

// Function to display the section corresponding to the clicked button
function showSection(sectionId) {
    // Hide all sections and remove the 'active' class from buttons
    sections.forEach(section => {
        section.style.display = 'none';
    });

    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Show the corresponding section
    const activeSection = document.querySelector(`#${sectionId}`);
    if (activeSection) {
        activeSection.style.display = 'block';
    }

    // Add the 'active' class to the clicked button
    const activeButton = document.querySelector(`a[href="#${sectionId}"] .options`);
    if (activeButton) {
        activeButton.classList.add('active');
    }
}

// Add event listeners to each button
buttons.forEach(button => {
    button.addEventListener('click', function () {
        const sectionId = this.parentElement.getAttribute('href').substring(1);
        showSection(sectionId);
    });
});

// Initially display the first section
showSection('rent_bike');
