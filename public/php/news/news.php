<?php 
    if(isset($_GET['clan'])){
        if(isset($_SESSION['Username'])&&isset($_SESSION['Password'])){
            switch($_GET['clan']){
                case 'add':include 'addNews.php';break;
                case 'delete':include 'newsList.php';break;
                case 'edit':include 'editArticel.php';break;
                default:include 'newsArticle.php';
            }
        } else{
            switch($_GET['clan']){
                case 'add':header('location:index.php');break;
                case 'delete':header('location:index.php');break;
                case 'edit':header('location:index.php');break;
                default:include 'newsArticle.php';
            }
        }
    } else{
        include('php/news/newsList.php');
    } 
?>