
 <div class="col s12">
     <div class="input-field col l5 s11">
         <select name="author[]">
             <option value="" disabled selected>Выберите автора объекта</option>
             <?php foreach ($authors as $author): ?>
                 <?php if( ! in_array($author->id, $authorIds)): ?>
                 <option value="<?=$author->id?>"><?=$author->name?></option>
                 <?php endif; ?>
             <?php endforeach; ?>
         </select>
         <label>Автор</label>
     </div>
     <div class="input-field col l6 s11">
         <select name="role[<?=$roleIndex?>][]" multiple>
             <option value="" disabled selected>Роли этого автора</option>
             <?php foreach ($roles as $role): ?>
                 <option value="<?=$role->id?>"><?=$role->name?></option>
             <?php endforeach; ?>
         </select>
         <label>Роли</label>
     </div>
     <div class="input-field col l1 s2">
         <a class="btn-floating red remove-row" href="javascript:;"><i class="material-icons">remove_circle_outline</i></a>
     </div>
 </div>