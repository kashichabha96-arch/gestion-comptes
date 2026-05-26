from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
import time

# ============================================================
# Configuration
# ============================================================
BASE_URL = "http://127.0.0.1:8000"   # Laravel | ou: http://localhost/gestion-comptes/public
EMAIL    = "admin@gmail.com"
PASSWORD = "123456"

# ============================================================
# Setup Chrome (ChromeDriver automatique)
# ============================================================
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

# ============================================================
# TEST 1: La page Login s'affiche
# ============================================================
print("\n🔵 TEST 1: La page Login s'affiche")
try:
    driver.get(f"{BASE_URL}/login")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    log("La page login se charge correctement", True)
except Exception as e:
    log("La page login se charge correctement", False, str(e))

# ============================================================
# TEST 2: Login avec mauvaises informations
# ============================================================
print("\n🔵 TEST 2: Login avec mauvaises informations")
try:
    driver.get(f"{BASE_URL}/login")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    driver.find_element(By.NAME, "email").clear()
    driver.find_element(By.NAME, "email").send_keys("faux@test.com")
    driver.find_element(By.NAME, "password").clear()
    driver.find_element(By.NAME, "password").send_keys("mauvais")
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    time.sleep(2)
    assert "/login" in driver.current_url
    log("Login avec mauvaises infos reste sur /login", True)
except Exception as e:
    log("Login avec mauvaises infos reste sur /login", False, str(e))

# ============================================================
# TEST 3: Login avec bonnes informations
# ============================================================
print("\n🔵 TEST 3: Login avec bonnes informations")
try:
    driver.get(f"{BASE_URL}/login")
    wait.until(EC.presence_of_element_located((By.TAG_NAME, "form")))
    driver.find_element(By.NAME, "email").clear()
    driver.find_element(By.NAME, "email").send_keys(EMAIL)
    driver.find_element(By.NAME, "password").clear()
    driver.find_element(By.NAME, "password").send_keys(PASSWORD)
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    time.sleep(2)
    assert "/dashboard" in driver.current_url or "/home" in driver.current_url
    log("Login correct redirige vers le Dashboard", True)
except Exception as e:
    log("Login correct redirige vers le Dashboard", False, str(e))

# ============================================================
# TEST 4: Le Dashboard affiche les statistiques
# ============================================================
print("\n🔵 TEST 4: Le Dashboard affiche les statistiques")
try:
    assert "/dashboard" in driver.current_url or "/home" in driver.current_url
    page = driver.page_source.lower()
    assert any(word in page for word in ["compte", "client", "carte", "statistique", "total"])
    log("Le Dashboard contient des statistiques", True)
except Exception as e:
    log("Le Dashboard contient des statistiques", False, str(e))

# ============================================================
# TEST 5: Déconnexion (Logout)
# ============================================================
print("\n🔵 TEST 5: Déconnexion")
try:
    logout_btn = None
    # محاولة إيجاد زر logout بعدة طرق
    for selector in [
        (By.CSS_SELECTOR, "a[href*='logout']"),
        (By.CSS_SELECTOR, "form[action*='logout'] button"),
        (By.XPATH, "//*[contains(text(),'Logout') or contains(text(),'Déconnexion') or contains(text(),'logout')]"),
    ]:
        try:
            logout_btn = driver.find_element(*selector)
            break
        except:
            continue

    if logout_btn:
        logout_btn.click()
        time.sleep(2)
        assert "/login" in driver.current_url or driver.current_url == f"{BASE_URL}/"
        log("Déconnexion redirige vers /login", True)
    else:
        log("Déconnexion redirige vers /login", False, "Bouton logout introuvable")
except Exception as e:
    log("Déconnexion redirige vers /login", False, str(e))

# ============================================================
# Résultat final
# ============================================================
print("\n" + "=" * 50)
print(f"  📊 Résultats : {passed} ✅ réussis | {failed} ❌ échoués")
print("=" * 50)

time.sleep(3)
driver.quit()