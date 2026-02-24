# 🚀 Déploiement sur Railway

## Configuration Requise

### Option 1: Avec Base de Données MySQL/PostgreSQL (Recommandé)

1. **Ajouter un plugin de base de données** dans Railway:
   - Allez à votre projet Railway
   - Cliquez sur `+ New`
   - Sélectionnez `MySQL` ou `PostgreSQL`
   - Railway générera automatiquement `DATABASE_URL`

2. **Variables d'environnement automatiques**:
   - `DATABASE_URL` sera auto-générée par Railway
   - Notre `RailwayServiceProvider` parsera automatiquement cette URL

3. **Le déploiement gérera tout**:
   - Les migrations s'exécuteront au premier démarrage via `start.sh`
   - Les sessions seront sauvegardées sur le filesystem (non dans la BD)

### Option 2: Utiliser une BD Externe

1. **Configurer manuellement dans Railway**:
   - Aller à Paramètres → Variables
   - Ajouter `DATABASE_URL=mysql://user:pass@host:port/dbname`

## Variables d'Environnement Railroad

Le service provider analyse automatiquement:
- **DATABASE_URL** (généré automatiquement si plugin ajouté)
- OU individuellement: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

## Déploiement

```bash
git push  # Railroad détecte les changements et redéploie automatiquement
```

## Débogage

1. **Vérifier les logs**:
   ```
   Railway Dashboard → Logs
   ```

2. **Vérifier les variables d'environnement**:
   ```
   Railway Dashboard → Settings → Variables
   ```

3. **Tester la connexion DB localement**:
   ```bash
   # Avec DATABASE_URL
   DATABASE_URL="mysql://..." php artisan migrate --force
   ```

---

**Notes**:
- ✅ Sessions sauvegardées en fichier (pas en DB)
- ✅ Cache en fichier (pas en DB)
- ✅ Queue synchrone (pas de workers)
- ✅ Les migrations s'exécutent automatiquement au démarrage
