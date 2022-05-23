<script>
        //menu toggle
        let toggle = document.querySelector('.toggle');
        let main = document.querySelector('.main');
        let navigation = document.querySelector('.navigation');

        let formClose = document.querySelector('#form-close');
        let updateForm = document.querySelector('.update-form-container');           
        let formBtn = document.querySelector('#add-btn');


        toggle.onclick = function(){
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }
        
        //add hovered class in selected list item
        let list = document.querySelectorAll('.navigation li');
        function activeLink() {
            list.forEach((item) => 
              item.classList.remove('hovered'));
              this.classList.add('hovered');
            
        }

        list.forEach((item) =>
        item.addEventListener('mouseover',activeLink));

        formBtn.addEventListener('click', () =>{
                updateForm.classList.add('active');
            });

           

        formClose.addEventListener('click', () =>{
                loginForm.classList.remove('active');
            });
   </script>

       
</body>
</html>