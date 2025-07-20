// script.js

function calculateFee() {
  const credits = document.getElementById('credits').value;
  const perCredit = document.getElementById('perCredit').value;
  const total = credits * perCredit;
  document.getElementById('totalFee').textContent = `Total Fee: BDT ${total}`;
}
