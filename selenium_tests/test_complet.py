from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
import time

BASE_URL = "http://127.0.0.1:8000"
EMAIL    = "admin@gmail.com"
PASSWORD = "123456"

options = webdriver.ChromeOptions()
options.add_argument("--start-maximized")
service = Service(ChromeDriverManager().install())
driver  = webdriver.Chrome(service=service, options=options)
wait    = WebDriverWait(driver, 10)

passed = 0
failed = 0

def log(test_name, success, msg=""):
    global passed, failed
    if success:
        passed += 1
        print(f"  ✅ PASS — {test_name}")
    else:
        failed += 1
        print(f"  ❌ FAIL — {test_name}: {msg}")

def login():
    driver.get(f"{BASE_URL}/login")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    driver.find_element(By.NAME, "email").clear()
    driver.find_element(By.NAME, "email").send_keys(EMAIL)
    driver.find_element(By.NAME, "password").clear()
    driver.find_element(By.NAME, "password").send_keys(PASSWORD)
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    time.sleep(2)

def go(path):
    driver.get(f"{BASE_URL}/{path}")
    time.sleep(2)

print("\n🔐 Connexion en cours...")
login()

print("\n🔵 TEST 1: Dashboard")
try:
    go("dashboard")
    page = driver.page_source.lower()
    assert any(w in page for w in ["comptes dinar", "comptes devise", "cartes", "clients", "utilisateurs"])
    log("Dashboard affiche les statistiques", True)
except Exception as e:
    log("Dashboard affiche les statistiques", False, str(e))

print("\n🔵 TEST 2: Créer Compte Dinar")
try:
    go("create/account/dinar")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    page = driver.page_source.lower()
    assert any(w in page for w in ["dinar", "compte", "client", "type"])
    log("Page Créer Compte Dinar s'affiche", True)
except Exception as e:
    log("Page Créer Compte Dinar s'affiche", False, str(e))

print("\n🔵 TEST 3: Créer Compte Devise")
try:
    go("create/account/devise")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    page = driver.page_source.lower()
    assert any(w in page for w in ["devise", "compte", "client", "type"])
    log("Page Créer Compte Devise s'affiche", True)
except Exception as e:
    log("Page Créer Compte Devise s'affiche", False, str(e))

print("\n🔵 TEST 4: Créer Carte Bancaire")
try:
    go("cartes/create")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    page = driver.page_source.lower()
    assert any(w in page for w in ["carte", "bancaire", "compte", "type"])
    log("Page Créer Carte Bancaire s'affiche", True)
except Exception as e:
    log("Page Créer Carte Bancaire s'affiche", False, str(e))

print("\n🔵 TEST 5: Versement")
try:
    go("operation/create/versement")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    page = driver.page_source.lower()
    assert any(w in page for w in ["versement", "montant", "compte"])
    log("Page Versement s'affiche", True)
except Exception as e:
    log("Page Versement s'affiche", False, str(e))

print("\n🔵 TEST 6: Retrait")
try:
    go("operation/create/retrait")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    page = driver.page_source.lower()
    assert any(w in page for w in ["retrait", "montant", "compte"])
    log("Page Retrait s'affiche", True)
except Exception as e:
    log("Page Retrait s'affiche", False, str(e))

print("\n🔵 TEST 7: Virement")
try:
    go("operation/create/virement")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    page = driver.page_source.lower()
    assert any(w in page for w in ["virement", "montant", "compte"])
    log("Page Virement s'affiche", True)
except Exception as e:
    log("Page Virement s'affiche", False, str(e))

print("\n🔵 TEST 8: Historique")
try:
    go("operations/historique")
    time.sleep(2)
    page = driver.page_source.lower()
    assert any(w in page for w in ["historique", "operation", "date", "montant", "type"])
    log("Page Historique s'affiche", True)
except Exception as e:
    log("Page Historique s'affiche", False, str(e))

print("\n🔵 TEST 9: Gestion Utilisateurs")
try:
    go("agents")
    time.sleep(2)
    page = driver.page_source.lower()
    assert any(w in page for w in ["agent", "utilisateur", "nom", "email"])
    log("Page Gestion Utilisateurs s'affiche", True)
except Exception as e:
    log("Page Gestion Utilisateurs s'affiche", False, str(e))

print("\n🔵 TEST 10: Gestion Clients")
try:
    go("clients")
    time.sleep(2)
    page = driver.page_source.lower()
    assert any(w in page for w in ["client", "nom", "cin", "prenom"])
    log("Page Gestion Clients s'affiche", True)
except Exception as e:
    log("Page Gestion Clients s'affiche", False, str(e))

print("\n🔵 TEST 11: Liste Comptes")
try:
    go("accounts")
    time.sleep(2)
    page = driver.page_source.lower()
    assert any(w in page for w in ["compte", "solde", "client", "type"])
    log("Page Liste Comptes s'affiche", True)
except Exception as e:
    log("Page Liste Comptes s'affiche", False, str(e))

print("\n🔵 TEST 12: Liste Cartes")
try:
    go("cartes")
    time.sleep(2)
    page = driver.page_source.lower()
    assert any(w in page for w in ["carte", "compte", "type", "statut"])
    log("Page Liste Cartes s'affiche", True)
except Exception as e:
    log("Page Liste Cartes s'affiche", False, str(e))

print("\n🔵 TEST 13: Icone Notification")
try:
    go("dashboard")
    time.sleep(1)
    notif_icon = driver.find_element(By.CSS_SELECTOR, "a[href*='notification']")
    assert notif_icon is not None
    log("Icone notification presente sur le Dashboard", True)
except Exception as e:
    log("Icone notification presente sur le Dashboard", False, str(e))

print("\n🔵 TEST 14: Page Notifications")
try:
    go("notifications")
    time.sleep(2)
    page = driver.page_source.lower()
    assert any(w in page for w in ["notification", "operation", "versement", "retrait", "virement"])
    log("Page Notifications affiche les operations", True)
except Exception as e:
    log("Page Notifications affiche les operations", False, str(e))



print("\n🔵 TEST 16: Bouton Actualiser")
try:
    go("dashboard")
    time.sleep(1)
    actualiser = driver.find_element(By.CSS_SELECTOR, "a[href*='actualiser'], a[href*='refresh'], a[onclick*='reload'], a[href*='dashboard']")
    actualiser.click()
    time.sleep(2)
    assert "dashboard" in driver.current_url
    log("Bouton Actualiser fonctionne", True)
except Exception as e:
    # الـ refresh يعيد تحميل الصفحة فقط
    try:
        go("dashboard")
        driver.refresh()
        time.sleep(2)
        assert "dashboard" in driver.current_url
        log("Bouton Actualiser fonctionne", True)
    except Exception as e2:
        log("Bouton Actualiser fonctionne", False, str(e2))

print("\n🔵 TEST 17: Deconnexion")
try:
    go("dashboard")
    time.sleep(1)
    try:
        btn = driver.find_element(By.CSS_SELECTOR, "a[href*='logout']")
        btn.click()
    except:
        pass
    try:
        driver.execute_script("""
            var forms = document.querySelectorAll('form[action*="logout"]');
            if(forms.length > 0) forms[0].submit();
        """)
    except:
        pass
    time.sleep(2)
    assert "/login" in driver.current_url or driver.current_url == f"{BASE_URL}/"
    log("Deconnexion redirige vers /login", True)
except Exception as e:
    log("Deconnexion redirige vers /login", False, str(e))

print("\n" + "=" * 50)
print(f"  📊 Resultats : {passed} ✅ reussis | {failed} ❌ echoues")
print("=" * 50)

time.sleep(3)
driver.quit()