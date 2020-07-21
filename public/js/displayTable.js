
function formatDate (date){
    const fullDateString = moment(date).locale('fr_Fr').format('LL');
    return fullDateString;
 }
function displayResult(procedure,typ,t){
    let perPage = 3;
    let startCount = 0;
    let rechResult;
    let query= $('.rech-input').val();
         let rechBy = $(`#select${typ}`).val();
         let type;
         if(query == ''){
            const s = window.location.href.indexOf('=') ;
            let c;
            if(s != -1 ){
                c = window.location.href.slice(s+1);
            }else{
                c = 1;
            }
            startCount =(perPage * c) - perPage;
            rechResult = procedure.slice(startCount,startCount + perPage)
            type = 0;
            $('ul.pagination').show();
         }else{
           type = 1;
            rechResult =  procedure.filter((row)=>{
                if(rechBy == 'id')
                    return row.id == query;
                else if(rechBy == 'date_audience')
                    return row.date_audience == formatDate(new Date(query));
                else if(rechBy == 'civile_type_id')
                     return row.type.description == query;
                else
                  return row.numero_quittance == query;
                });
                console.log(rechResult)
         }
        displayByPagination(procedure,rechResult,perPage,startCount,query,type,t);
        if( rechResult.length > 0)
               displayResultPagination(procedure,perPage,rechResult,type,startCount,query,t);
        
        if(rechResult.length > 0 && type == 1){
             $('ul.pagination li:last').removeClass('disabled');
             $('ul.pagination li:first').removeClass('disabled');
             $('ul.pagination li:first').children('span,a').removeAttr('href').css({'cursor':'pointer','color':'#007bff'})
             .click(function(){
                if($('ul.pagination li.active').text() != 1 ){
                    startCounter = (2 * parseInt($('ul.pagination li.active').text())) - 2 - perPage;
                    displayResultWhenLinkClicked($('ul.pagination li.active').prev('li'),procedure,rechResult,perPage,startCounter,query,type,'prev');

                }
            });
             $('li:last').removeClass('disabled').children('span,a').removeAttr('href').css({'cursor':'pointer','color':'#007bff'}).click(function(){
                if(parseInt($('ul.pagination li.active').text()) < Math.ceil(rechResult.length/perPage)){
                    startCounter =  2 *parseInt($('ul.pagination li.active').text());
                    displayResultWhenLinkClicked($('ul.pagination li.active').next('li'),procedure,rechResult,perPage,startCounter,query,type,'next');
                }
             });

        }


 }
 function displayByPagination(procedure,rechResult,itemByPage,startCount,query,type,t){
            const proced = t =='referes' ? 'rèfèrè' : 'procèdure';
            const h = t =='civiles' ? '<th>type</th>' :'';
            let table =`<thead>
                    <tr>
                    <th>N° ${proced}</th>
                    <th>Date d'audience</th>
                    ${h}
                    <th></th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                `;
            let tableRows ='';
            let result;
        if(query == ''){
            result = rechResult;
        }else{
            result = rechResult.slice(startCount ,startCount + itemByPage);
        }
           
           result.forEach((row)=>{
            const d = t =='civiles' ? `<td>${row.type.description}</td>` :'';
                tableRows = `${tableRows}
                               <tr>
                                <td>${row.id}</td>
                                <td>${row.date_audience}</td>
                                ${d}
                                <td><a href="${t}/${row.id}" class="btn btn-sm btn-outline detail">Dètails</td>
                               <td style="font-size:12px;">

                 `;
                 if(!row.numero_quittance && row.type?.id != 3){
                    tableRows = `${tableRows}
                                    <form method="get" action ="/role/general/${t}/${row.id}">
                                       <button class="btn btn-secondary">Ajouter dans rôle gènèral</button>
                                    </form>
                                    </tr>
                                    </tbody>
                                `
                }else{
                   tableRows = `${tableRows}
                                </tr>
                    </tbody>
                                `
                }
             });
             table = table + tableRows;
             if(rechResult.length > 0){
                 $('#table-info').html(table);
                 if(rechResult.length > itemByPage)
                    $('ul.pagination').show();
                 else{
                     if(type == 1)
                       $('ul.pagination').hide();
                 }
             }
             else{
                $('#table-info').html('<tbody><td class="d-flex justify-content-center">Pas de resultats</td></tbody>');
                $('ul.pagination').hide();
             }



 }
 function displayResultPagination(procedure,itemByPage,rechResult,type,startCounter,query,t){
    if(type == 1 ){
        const total = Math.ceil(procedure.length/itemByPage);
       $(`ul.pagination li:gt(0):lt(${total})`).each(function (){
             if(parseInt($(this).text()) > Math.ceil(rechResult.length/itemByPage)){
                $(this).hide();
                $(this).attr('status','hide');
                $(this).removeClass('active');
             }else{
                 if($(this).text() == startCounter + 1)
                     $(this).addClass('active');
                 else{
                    $(this).removeClass('active').css('color','#007bff');

                 }
                $(this).children('a').removeAttr('href');
                if( $(this).attr('class').indexOf('active') ){
                    $(this).css('cursor','pointer');
                }else{
                    $(this).css('cursor','pointer');
                }

                 $(this).click(function(){
                    displayResultWhenLinkClicked($(this),procedure,rechResult,itemByPage,startCounter,query,type,'click');

                });
            }
            });
  }else{
      startCounter = 0;
      let liTotal = Math.ceil(procedure.length/itemByPage);
      $('li.page-item').each(function(){
          if($(this).attr('status') == 'hide'){
              $(this).show();
              $(this).removeAttr('status');
          }
      });
      $(`ul li.page-item:gt(0):lt(${liTotal})`).each(function(){
          const egalPos = window.location.href.indexOf('=');
          const currentPage = egalPos != -1 ? window.location.href.slice(egalPos + 1) : 1;
          console.log(currentPage)
          const c = $(this).text();
          $(this).children('a').attr('href',`${t}?page=${c}`);
            if($(this).text() != currentPage)
               $(this).removeClass('active');
            else{
              $(this).addClass('active');
              if($(this).text() == '1'){
                  $('ul.pagination li:first').addClass('disabled');
              }else{
                $('ul.pagination li:first').children('a:first').attr('href',`${t}?page=`+ (parseInt($(this).text()) - 1));
              }
              if($(this).text() == liTotal){
                $('ul.pagination li:last').addClass('disabled');
              }else{
                $('ul.pagination li:last').children('a:first').attr('href',`${t}?page=`+ (parseInt($(this).text()) + 1));
              }
            }
        

      });


  }
}
function displayResultWhenLinkClicked(thi,procedure,rechResult,itemByPage,startCounter,query,type,direction,first){
    if(direction == 'prev'){
        if($('.rech-input').val() != ''){
            displayByPagination(procedure,rechResult,itemByPage,startCounter,query,type,true);
            $('ul.pagination li.active').removeClass('active').css('color','#007bff');
            thi.addClass('active');
        }
    }else if(direction == 'next'){
        if($('.rech-input').val() != ''){
            displayByPagination(procedure,rechResult,itemByPage,startCounter,query,type,true);
            $('ul.pagination li.active').removeClass('active').css('color','#007bff');;
            thi.addClass('active');
        }
    }else{ 
        if($('.rech-input').val() != ''){
            startCounter = (2 * parseInt(thi.text())) - itemByPage;
            if(startCounter >= 0){
                displayByPagination(procedure,rechResult,itemByPage,startCounter,query,type,true);
                $('ul.pagination li.active').removeClass('active').css('color','#007bff');;
                thi.addClass('active');

            }
        }
    }

}

