// script.js

document.addEventListener('DOMContentLoaded', () => {
    // Toggle navbar menu for mobile (optional feature)
    const navbar = document.querySelector('.navbar');
  
    // Example of dynamically loading notices
    const notices = [
      'Spring 2025 registration ongoing.',
      'Midterm exam schedule published.',
      'New research grant for AI projects.',
      'Campus will remain closed on May 10.',
    ];
  
    const noticeList = document.querySelector('.notice ul');
    if (noticeList) {
      notices.forEach(notice => {
        const li = document.createElement('li');
        li.textContent = notice;
        noticeList.appendChild(li);
      });
    }
  
    // Simple scroll animation
    const sections = document.querySelectorAll('section');
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, {
      threshold: 0.1
    });
  
    sections.forEach(section => {
      section.classList.add('hidden');
      observer.observe(section);
    });
  });
  