document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal');
    const closeBtn = document.getElementById('modal-close');
    const deleteForm = document.getElementById('delete-form');
    if (!deleteForm) {
    console.warn('delete-form が見つかりませんでした');
    }


    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', function () {
            alert('詳細ボタン押されたよ！');



            // ✅ モーダルにデータをセット
            document.getElementById('modal-name').textContent = this.dataset.name;
            document.getElementById('modal-gender').textContent = this.dataset.gender;
            document.getElementById('modal-email').textContent = this.dataset.email;
            document.getElementById('modal-phone').textContent = this.dataset.tel;
            document.getElementById('modal-address').textContent = this.dataset.address;
            document.getElementById('modal-type').textContent = this.dataset.category;
            document.getElementById('modal-detail').textContent = this.dataset.detail;

            // ✅ 削除フォームのアクションをセット
            deleteForm.action = `/admin/${this.dataset.id}`;

            // ✅ モーダル表示
            modal.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
    });
});