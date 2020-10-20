<?php
namespace ORM\User\Model;
use OCFram\Manager;
use ORM\User\Entity\User;
use ORM\Chaine\Entity\Chaine;

class ManagerUser extends Manager {

	function selectUsersByChaine($id_chaine){
		$id = $this->db->real_escape_string($id_chaine);

		$req = "
			SELECT * FROM user WHERE chaine_id_chaine = $id
		";

		$query = $this->db->query($req);
		if($query->num_rows > 0){
			while($row = $query->fetch_array()){
				$tableau[] = new User($row);
			}
			return $tableau;
		}else{
			NULL;
		}
	}

	//----------------------------------------------------------
	//En création de profil, verification si le mail du user 
	//existe déjà dans la table ou pas
	//----------------------------------------------------------
	function userExist($email){
		$email_user = $this->db->real_escape_string($email);

		$req = "SELECT * 
			FROM user 
				WHERE email_user = '$email_user'
		";

		$query = $this->db->query($req);
		return ($query->num_rows == 1)?new User($query->fetch_array()):NULL;

	}

	//----------------------------------------------------------
	//Si le mail du user n'existe pas dans la table, on doit
	//lui créer un nouveau compte (insertion d'un nouveau profil)
	//----------------------------------------------------------
	function insertUser(User $objet){
		//Nettoyer ce qui provient de la saisie de l'internaute
		$nom_user			= $this->db->real_escape_string($objet->getNomUser());
		$prenom_user		= $this->db->real_escape_string($objet->getPrenomUser());
		$email_user			= $this->db->real_escape_string($objet->getEmailUser());
		$pass_user			= hash("whirlpool",$objet->getPassUser());

		//Pas utile si on est sûr de ce qui provient de l'application
		$rgpd_user				= $objet->getRgpdUser();
		$date_rgpd_user			= $objet->getDateRgpdUser();
		$statut_user			= $objet->getStatutUser();		
		$actif_user				= $objet->getActifUser();
		$token_mdp_user			= $objet->getTokenMdpUser();
		$date_token_mdp_user 	= $objet->getDateTokenMdpUser();

		$req = "INSERT INTO user 
			VALUES(
				NULL,
				'$nom_user',
				'$prenom_user',
				'$email_user',
				'$pass_user',
				NULL,
				'$date_rgpd_user',
				$rgpd_user,
				NULL,
				$statut_user,
				$actif_user,
				'$token_mdp_user',
				'$date_token_mdp_user',
				NULL,
				NULL,
				NULL
			)
		";


		$query = $this->db->query($req);
		return $this->db->insert_id;
	}


	//----------------------------------------------------------
	//L'activation du compte (via la réception d'un mail 
	//d'activation) nécessite de savoir si un token valide (avec
	//une durée de validité non périmée) existe dans la table
	//----------------------------------------------------------
	function oneUserByTokenValid($token){
		if(is_numeric($token)){
			$req 	= "SELECT * 
				FROM user 
					WHERE 
						token_mdp_user = '$token' 
						AND date_token_mdp_user >= NOW()
			";

			$query 	= $this->db->query($req);
			return ($query->num_rows > 0)?new User($query->fetch_array()):NULL;
		}
	}

	function oneUserByTokenChaineValid($token){
		$token = $this->db->real_escape_string($token);
			$req 	= "SELECT * 
				FROM user 
					WHERE 
						token_invitation_user = '$token' 
						AND date_token_invitation_user >= NOW()
			";

			$query 	= $this->db->query($req);
			return ($query->num_rows > 0)?new User($query->fetch_array()):NULL;
	}
	//----------------------------------------------------------
	//Si le controller pointe un token valide
	//il lance l'update pour activer le User
	//----------------------------------------------------------
	function updateActivationUser(User $user){
		$req = "UPDATE user SET 
			actif_user		= 1, 
			statut_user 	= 1
			WHERE id_user = ".$user->getIdUser();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateAddesionUser(User $user){
		$idChaine = $this->db->real_escape_string($user->getChaineIdChaine());
		$req = "UPDATE user SET  
			statut_user 	= 2,
			chaine_id_chaine = ".$idChaine."
			WHERE id_user = ".$user->getIdUser();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	//----------------------------------------------------------
	//S'il faut réattribuer un token 
	//(user trop lent pour activer son compte)
	//----------------------------------------------------------
	function updateTokenUser(User $user){
		$req = "UPDATE user SET 
			token_mdp_user			= '".$user->getTokenMdpUser()."', 
			date_token_mdp_user 	= '".$user->getDateTokenMdpUser()."'
			WHERE id_user 			= ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateTokenChaineUser(User $user){
		$req = "UPDATE user SET 
			token_invitation_user			= '".$user->getTokenInvitationUser()."', 
			date_token_invitation_user 	= '".$user->getDateTokenInvitationUser()."'
			WHERE id_user 			= ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	//----------------------------------------------------------
	//Et pour se connecter ?
	//----------------------------------------------------------
	function connectUser($login,$pass){
		$login_user 	= $this->db->real_escape_string($login);
		$pass_user 		= hash("whirlpool",$pass);

		$req = "SELECT * FROM user 
			WHERE 
				email_user = '$login_user' 
				AND pass_user = '$pass_user' 
				AND actif_user = 1 
				AND statut_user > 0
		";
		$query = $this->db->query($req);
		return ($query->num_rows == 1)?new User($query->fetch_array()):NULL;
	}

	//----------------------------------------------------------
	//On update juste le mot de passe du User
	//----------------------------------------------------------
	function updatePassUser(User $user){
		$pass_user		= hash("whirlpool",$user->getPassUser());
		
		$req = "UPDATE user SET 
			pass_user		= '$pass_user'
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function updateStatutChaineUser(User $user,Chaine $chaine){
		$id_chaine = $chaine->getIdChaine();
		$req = "UPDATE user SET 
			statut_user			= 2,
			chaine_id_chaine	= $id_chaine 
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}

	function removeStatutChaineUser(User $user){
		$req = "UPDATE user SET 
			statut_user			= 1,
			chaine_id_chaine	= NULL 
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}


	//----------------------------------------------------------
	//Pour laisser un User modifier son profil, 
	//on commence par récupérer tout ce qui le concerne
	//----------------------------------------------------------
	function oneUserById($id){
		if(is_numeric($id)){
			$req 	= "
				SELECT * FROM user 
				WHERE id_user = $id 
			";
			$query 	= $this->db->query($req);
			return ($query->num_rows == 1)?new User($query->fetch_array()):NULL;
		}
	}
	//----------------------------------------------------------
	//Mais un User ne peut modifier son profil 
	//sans retaper son mot de passe actuel
	//----------------------------------------------------------
	function oneUserByIdAndPass(User $user) {
		$pass_user  = hash("whirlpool",$user->getPassUser());
		$req 	= "SELECT * FROM user 
			WHERE pass_user = '$pass_user' 
				AND id_user = ".$user->getIdUser();
		$query 	= $this->db->query($req);
		return ($query->num_rows == 1)?TRUE:FALSE;
	}

	function updateProfil(User $user){
		$nom_user		= $this->db->real_escape_string($user->getNomUser());
		$prenom_user	= $this->db->real_escape_string($user->getPrenomUser());
		$email_user		= $this->db->real_escape_string($user->getEmailUser());
		
		$req = "UPDATE user SET 
				nom_user			= '$nom_user',
				prenom_user		= '$prenom_user',
				email_user		= '$email_user' 
			WHERE id_user = ".$user->getIdUser();
		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}


	//----------------------------------------------------------
	//Supprimer compte (en supprimant d'abord les résa)
	//----------------------------------------------------------
	function deleteUser(User $user){
		$id = $user->getIdUser();
		$req = "DELETE FROM `user` 
		WHERE id_user = $id";
		$query = $this->db->query($req);
		
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}


	//----------------------------------------------------------
	//Modifier Avatar
	//----------------------------------------------------------
	function updateAvatar(User $user){
		$avatar = $user->getAvatarUser();
		$req = "UPDATE user 
			SET avatar_user = '$avatar'
			WHERE id_user =".$user->getIdUser();

		$query = $this->db->query($req);
		return ($this->db->affected_rows == 1)?TRUE:FALSE;
	}



//Fermeture ManagerUser
}
?>